@extends('admin.master')
@section('access_control', 'active submenu')
@section('access_collapse', 'show')
@section('role_list','active')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Role : {{ $role->name }}</h4>

                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('role.give.permission', $role->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between mt-5">
                                <h2 class="addRole">Add/Remove Permission</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox my-3">
                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                <label class="custom-control-label" for="checkAll"><b>{{ __('Select all') }}</b></label>
                            </div>
                        </div>

                        @foreach ($permissions as $index => $modules)
                            <div class="col-xl-6 col-lg-6 col-md-6 mb-2">
                                <table class="card shadow p-3 mb-2 bg-body rounded"
                                    style="border: 1px sold #ddd;padding:15px">
                                    <tbody>
                                        <tr class="row">
                                            <td colspan="2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <strong
                                                            style="font-size:16px;padding-bottom:8px">{{ ucfirst($index) }}</strong>
                                                    </div>
                                                    <div>
                                                        <div class="custom-control custom-checkbox mb-1">
                                                            <input type="checkbox"
                                                                class="custom-control-input {{ $index }}"
                                                                onclick="checkByGroup('role_{{ $loop->iteration }}_id', this)"
                                                                id="permissionCheckbox{{ $index }}"
                                                                value="{{ $index }}">
                                                            <label class="custom-control-label">Select All</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="role_{{ $loop->iteration }}_id">
                                                @foreach ($modules as $permission)
                                                    <div class="custom-control custom-checkbox mb-1">
                                                        <input type="checkbox" name="permissions[]"
                                                            @if ($role->hasPermissionTo($permission->id)) checked @endif
                                                            class="custom-control-input {{ $index }}"
                                                            id="permissionCheckbox{{ $permission->id }}"
                                                            value="{{ $permission->name }}">
                                                        <label
                                                            class="custom-control-label">{{ ucfirst(str_replace(['.', '-'], ' ', $permission->name)) }}</label>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>

                            </div>
                        @endforeach

                    </div>
                    <button class="btn btn-info waves-effect waves-float waves-light float-right mb-4 mt-3"
                        type="submit">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $('#checkAll').click(function() {
            $('input:checkbox').prop('checked', this.checked);
        });

        function checkByGroup(className, checkThis) {
            const isChecked = checkThis.checked;
            const checkboxes = document.querySelectorAll('.' + className + ' input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        }
    </script>
@endpush
