@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('settings.create') }}" class="btn btn-primary">New Setting</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                            </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">								
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Copyright</th>
                                <th width="100">Status</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($settings->isNotEmpty())

                                @php $sno=1; @endphp

                                @foreach($settings as $setting)
                                <tr>
                                    <td>{{ $sno }}</td>
                                    <td>{{ $setting->title }}</td>
                                    <td>{{ $setting->email }}</td>
                                    <td>{{ $setting->phone }}</td>
                                    <td>{{ $setting->copyright }}</td>
                                    <td>
                                        <a href="{{ route('settings.edit', [$setting->id]) }}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        
                                        <a href="#" onclick="deleteSetting({{ $setting->id }})" class="text-danger w-4 h-4 mr-1">
                                            <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                        
                                    </td>
                                </tr>
                                    @php $sno++; @endphp
                                @endforeach

                            @else

                                <tr colspan="5">
                                    <td>No record found!</td>
                                </tr>

                            @endif
                        </tbody>
                    </table>										
                </div>
                
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

@endsection

@section('customJs')

<script>
    function deleteSetting(id){

        var url = '{{ route("settings.destroy","ID") }}';
        //alert(url);
        var newurl = url.replace("ID", id);

        if(confirm("Are you sure want to delete!")){

            $.ajax({
                url : newurl,
                type: 'delete',
                data: {},
                dataType: 'json',
                success: function(response){

                    if(response['status']==true){
                        window.location.href = "{{ route('settings.index') }}";
                    }

                },error: function(jqXHR,exception){
                    console.log("Something went wrong");
                }
            });
        }
    }
</script>
@endsection