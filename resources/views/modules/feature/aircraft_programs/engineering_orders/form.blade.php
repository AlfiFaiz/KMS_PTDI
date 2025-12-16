<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (dibutuhkan oleh Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="font-semibold">No Engineering Order</label>
        <input type="text" name="engineering_order_no"
            value="{{ old('engineering_order_no', $order->engineering_order_no ?? '') }}" class="form-control" required>
    </div>

    <div>
        <label class="font-semibold">Task</label>
        <select name="task_id" id="taskSelect" class="form-control" required>
            @foreach ($tasks as $t)
                <option value="{{ $t->id }}" @selected(old('task_id', $order->task_id ?? '') == $t->id)>
                    {{ $t->name }}
                </option>
            @endforeach
        </select>
    </div>

    <script>
        $(document).ready(function() {
            $('#taskSelect').select2({
                placeholder: "Pilih atau cari Task...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>




    <div>
        <label class="font-semibold">Start Date</label>
        <input type="date" name="start_date" value="{{ old('start_date', $order->start_date ?? '') }}"
            class="form-control" required>
    </div>

    <div>
        <label class="font-semibold">Finish Date</label>
        <input type="date" name="finish_date" value="{{ old('finish_date', $order->finish_date ?? '') }}"
            class="form-control">
    </div>

    <div>
        <label class="font-semibold">Type Order</label>
        <select name="type_order" class="form-control" required>
            @php
                $types = [
                    'Basic Re-assy and Functional Test',
                    'Customizing Functional Test',
                    'Flight Line',
                    'Maintenance',
                    'SB, ASB, AND EASB',
                ];
            @endphp
            @foreach ($types as $type)
                <option value="{{ $type }}" @selected(old('type_order', $order->type_order ?? '') == $type)>
                    {{ $type }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="font-semibold">Insp Stamp</label>
        <input type="text" name="insp_stamp" value="{{ old('insp_stamp', $order->insp_stamp ?? '') }}"
            class="form-control">
    </div>
</div>
