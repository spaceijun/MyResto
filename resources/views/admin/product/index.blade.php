@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> {{ $page }}</h4>
                <hr>
                <a class="btn btn-sm btn-success float-right" href="{{ route('product.create') }}">Tambah</a>
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
                                    Kategori
                                </th>
                                <th>
                                    Harga
                                </th>
                                <th>
                                    Deskripsi
                                </th>
                                <th>
                                    Gambar
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
                            @foreach ($products as $product)


                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td>
                                    {{ number_format($product->price) }}
                                </td>
                                <td>
                                    {{ $product->description }}
                                </td>
                                <td>
                                    <img src="{{ Storage::url($product->image) }}" height="75" width="75" alt="" />
                                </td>
                                <td>
                                    {{ $product->created_at }}
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center">

                                        <a href="{{ route('product.edit',$product->id) }}"
                                            class="btn btn-sm btn-primary m-1">Ubah</a>
                                        <form action="{{ route('product.destroy',$product->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return confirm('yakin hapus data ini?')"
                                                class="btn btn-sm btn-danger m-1">Hapus</button>
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