@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $page }}</h4>
                <hr>
                <a class="btn btn-sm btn-success float-right" href="{{ route('category.create') }}">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    Dibuat
                                </th>
                               
                                <th class="text-center">
                                    Opsi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                
                           
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                  {{ $category->created_at }}
                                </td>
                               
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                       
                                    <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-primary m-1">Ubah</a>
                                    <form action="{{ route('category.destroy',$category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('yakin hapus data ini?')" class="btn btn-sm btn-danger m-1">Hapus</button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection