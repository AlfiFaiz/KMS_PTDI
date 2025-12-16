<?php

namespace App\Http\Controllers;

use App\Models\EngineeringOrder;
use App\Models\AircraftProgram;
use App\Models\Task;
use Illuminate\Http\Request;

class EngineeringOrderController extends Controller
{
    public function index($aircraftProgramId)
    {
        $program = AircraftProgram::findOrFail($aircraftProgramId);
        $orders = $program->engineeringOrders()->with('task')->paginate(10);
        return view('modules.feature.aircraft_programs.engineering_orders.index', compact('program', 'orders'));
    }

    public function create($aircraftProgramId)
    {
        $program = AircraftProgram::findOrFail($aircraftProgramId);
        $tasks = Task::all();
        return view('modules.feature.aircraft_programs.engineering_orders.create', compact('program', 'tasks'));
    }

    public function store(Request $request, $aircraftProgramId)
    {
        $request->validate([
            'engineering_order_no' => 'required|string|max:255',
            'task_id' => 'required|exists:tasks,id',
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date',
            'type_order' => 'required|string|max:255',
            'insp_stamp' => 'nullable|string|max:255',
        ]);

        EngineeringOrder::create([
            'aircraft_id' => $aircraftProgramId,
            'engineering_order_no' => $request->engineering_order_no,
            'task_id' => $request->task_id,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'type_order' => $request->type_order,
            'insp_stamp' => $request->insp_stamp,
        ]);

        return redirect()->route('engineering-orders.index', $aircraftProgramId)->with('success', 'Engineering Order berhasil ditambahkan!');
    }

    public function edit($aircraftProgramId, $id)
    {
        $program = AircraftProgram::findOrFail($aircraftProgramId);
        $order = EngineeringOrder::findOrFail($id);
        $tasks = Task::all();
        return view('modules.feature.aircraft_programs.engineering_orders.edit', compact('program', 'order', 'tasks'));
    }

    public function update(Request $request, $aircraftProgramId, $id)
    {
        $order = EngineeringOrder::findOrFail($id);

        $request->validate([
            'engineering_order_no' => 'required|string|max:255',
            'task_id' => 'required|exists:tasks,id',
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date',
            'type_order' => 'required|string|max:255',
            'insp_stamp' => 'nullable|string|max:255',
        ]);

        $order->update($request->only('engineering_order_no', 'task_id', 'start_date', 'finish_date', 'type_order', 'insp_stamp'));

        return redirect()->route('engineering-orders.index', $aircraftProgramId)->with('success', 'Engineering Order berhasil diperbarui!');
    }

    public function destroy($aircraftProgramId, $id)
    {
        $order = EngineeringOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('engineering-orders.index', $aircraftProgramId)->with('success', 'Engineering Order berhasil dihapus!');
    }
}