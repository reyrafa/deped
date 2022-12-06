<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Management</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row mb-3">
                <div class="col-md-7"></div>
                <div class="col-md-2">
                    <a href="/usermanagement/addteacher" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Teacher</a>
                </div>
                <div class="col-md-3">
                    <div class="input-group">   
                        <div class="form-outline">
                          <input 
                              type="search" 
                              id="search" 
                              name="query"
                              class="form-control" 
                              placeholder="Search Data"/>
                        </div>
                        <button type="button" class="btn btn-success disabled">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>  
                </div>
            </div>
            <div class="bg-white overflow-hidden p-4 shadow-xl sm:rounded-lg">
                <h1 class="text-xl font-bold mb-2">Teacher's Data Table</h1>
                <div class="table-responsive">
                    <table class="table stripe align-middle hover" id="user_table" style="font-size: 12px;">
                        <thead> 
                            <th>Employee Id</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Middlename</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                           @foreach($teacher as $teacher_info)
                            <tr>
                                <td>{{$teacher_info->id_number}}</td>
                                <td>{{$teacher_info->firstname}}</td>
                                <td>{{$teacher_info->lastname}}</td>
                                <td>{{$teacher_info->middlename}}</td>
                                @foreach($user as $user_info)
                                    @if($teacher_info->id == $user_info->id)
                                        <td>{{$user_info->email}}</td>
                                        <td>{{$teacher_info->created_at->toDayDateTimeString()}}</td>
                                        <td style="color: blue; font-size: 12px">{{$teacher_info->updated_at->diffForHumans(['parts' => 2])}}</td>
                                        @if($user_info->user_status_id == '1')
                                            <td style="color: green;">Active</td>
                                            <td>
                                            <a type="button" href={{"/usermanagement/update_teacher/".$teacher_info->id}}  style="font-size: 10px;" class="btn btn-primary bg-primary"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                                            <a type="button" 
                                                href="#" 
                                                data-bs-toggle="modal"
                                                data-bs-target="#disable_account"
                                                style="font-size: 10px;" 
                                                data-id="{{$teacher_info->id}}"
                                                class="btn btn-danger bg-danger disableAccount">
                                                <i class="fa fa-trash" 
                                                aria-hidden="true">
                                                </i></a>
                                            </td>

                                        @else
                                            <td style="color: red;">Disabled</td>
                                            <td><a href="#" class="btn btn-info" style="font-size: 10px; margin-left:auto; margin-right:auto;"><i class="fa fa-repeat" aria-hidden="true"></i></a></td>
                                        @endif
                                    @endif
                                @endforeach
                                
                              
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="disable_account" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Disable Account</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                </div>
                <form  action="/disable_account" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="modal-body">
                    <input type="hidden" id="disable" name="id">
                    <x-jet-label>Are you sure you want to Disable this account?</x-jet-label>
                 </div>
                 <div class="modal-footer">
                     <button data-bs-dismiss="modal" type="button" class="btn btn-secondary bg-secondary">Close</button>
                     <button type="submit" class="btn btn-danger bg-danger" id="submit">Disable</button>
                 </div>

                 </form>
            </div>
        </div>
    </div>
    @push('script')

<script>
   
    $(document).ready( function () {
        //data table
       dtable = $('#user_table').DataTable({
            "language": {
            "search": "Filter records:"
            },
            "className": "text-center nosort text-nowrap",
           "lengthMenu": [5, 10, 20, 50],
           "bLengthChange": true,
           "columnDefs":[
               {"className": "dt:center", "targets": "_all"}
           ], 
           "dom" :"lrtrip",
           "order" :[[6, "desc"]],
     
           
          
        });

        //search function
        $('#search').keyup(function(){
            dtable.search($(this).val()).draw();
        })
        $(document).on('click', '.disableAccount', function(){
                var id = $(this).data('id');
                $('#disable').val(id)
            })
        
        } );
</script>
@endpush

@push('style')
    <style>
        #search{
            box-shadow: none;
        }
        div.dataTables_length select {
        width: 50px;
        }
    </style>
@endpush
</x-app-layout>