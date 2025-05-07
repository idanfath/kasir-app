@extends('layout')
@section('title', 'Edit Akun Kasir')
@section('content')
    @isset($officer)
        <div class="container mx-auto py-16 px-4">
            <div class="
                flex justify-between items-center ">
                <h2 class="text-3xl font-semibold ">Edit Akun Kasir: {{ $officer->name }}</h2>
                <button class="primary" onclick="history.back()">Kembali</button>
            </div>
            <x-separator class="my-6" />
            <div class="w-full flex justify-center">
                <form class="flex gap-2 flex-col min-lg:w-[50%] min-xl:w-[40%] w-full"
                    action="{{ route('officer.update', $officer) }}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="name" class="font-semibold text-lg">Nama
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" required placeholder="Masukkan nama kasir"
                        value="{{ $officer->name }}">
                    <label for="email" class="font-semibold text-lg">Email
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" required placeholder="Masukkan email kasir"
                        value="{{ $officer->email }}">
                    <label for="password" class="font-semibold text-lg">Password</label>
                    <input type="password" name="password" id="password" placeholder="(Opsional) Masukkan password baru"
                        oninput="handlePasswordInput(this)">
                    <script>
                        function handlePasswordInput(input) {
                            const passwordConfirmation = document.getElementById('password_confirmation');
                            const passwordConfirmationLabel = document.querySelector('.password_confirmation');
                            if (input.value.length > 0) {
                                passwordConfirmation.setAttribute('required', true);
                                passwordConfirmationLabel.classList.remove('hidden');
                                passwordConfirmation.classList.remove('hidden');
                            } else {
                                passwordConfirmation.removeAttribute('required');
                                passwordConfirmationLabel.classList.add('hidden');
                                passwordConfirmation.classList.add('hidden');
                                passwordConfirmation.value = '';
                            }
                        }
                    </script>
                    <label for="password_confirmation" class="password_confirmation hidden font-semibold text-lg">
                        Konfirmasi Password
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="hidden"
                        placeholder="Masukkan konfirmasi password baru">
                    <x-separator class="my-2" />
                    <button type="submit" class="success">
                        Simpan
                    </button>
                    <button type="reset" class="warn">
                        Reset
                    </button>
                </form>
            </div>
        </div>
    @endisset
@endsection
