@extends('layout')
@section('title', 'List Officer')
@section('content')
    @isset($officers)
        <div class="container mx-auto py-16 px-4">
            <div class="
                flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold ">Daftar Akun Kasir</h2>
                <a href="{{ route('officer.create') }}">
                    <button class="primary">Registrasi Akun Baru</button>
                </a>
            </div>
            <table class="pretty ">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($officers as $officer)
                        <tr>
                            <td>{{ $officer->name }}</td>
                            <td>{{ $officer->email }}</td>
                            <td class="flex gap-2">
                                <form action="{{ route('officer.destroy', $officer) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirm('Apakah Anda yakin ingin menghapus akun ini?') ? this.form.submit() : ''"
                                        class="danger">Hapus</button>
                                </form>
                                <button class="warn">
                                    <a href="{{ route('officer.edit', $officer) }}" class="edit">Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $officers->links('pagination::tailwind') }}
            </div>
        </div>
    @endisset
@endsection
