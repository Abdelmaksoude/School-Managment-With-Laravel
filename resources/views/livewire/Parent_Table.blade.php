<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('all_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    @if (!empty($successMessage))
    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ $successMessage }}
    </div>
@endif
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>{{ trans('all_trans.Processes') }}</th>
            <th>#</th>
            <th>{{ trans('all_trans.TheEmail') }}</th>
            <th>{{ trans('all_trans.Name_Father') }}</th>
            <th>{{ trans('all_trans.National_ID_Father') }}</th>
            <th>{{ trans('all_trans.Passport_ID_Father') }}</th>
            <th>{{ trans('all_trans.Phone_Father') }}</th>
            <th>{{ trans('all_trans.Job_Father') }}</th>

        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($my_parents as $my_parent)
            <tr>
                <?php $i++; ?>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('all_trans.Edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ trans('all_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
                <td>{{ $i }}</td>
                <td>{{ $my_parent->Email }}</td>
                <td>{{ $my_parent->Name_Father }}</td>
                <td>{{ $my_parent->National_ID_Father }}</td>
                <td>{{ $my_parent->Passport_ID_Father }}</td>
                <td>{{ $my_parent->Phone_Father }}</td>
                <td>{{ $my_parent->Job_Father }}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ trans('all_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>

</div>
