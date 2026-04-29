<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     @vite('resources/css/app.css', 'resources/js/app.js')
    <title>Document</title>
</head>
<body>
    <div class="main flex items-center justify-center w-full h-[100vh]">
        <div class="loginForm w-[30vw]  shadow-md p-5 border-1 border-gray-200 rounded">
        <h2 class="text-2xl font-[500]">Login </h2>
            <form action="" class="flex flex-col p-5 gap-5 loginForm" method="post">
                @csrf
                <div class="flex flex-col">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" placeholder="Enter email..." class="py-1 px-3 border-1 border-gray-200 rounded-xl">
                </div>
                <div class="flex flex-col">
                    <label for="">Password</label>
                    <input type="text" name="password" id=""placeholder="Enter password..." class="py-1 px-3 border-1 border-gray-200 rounded-xl">
                </div>
                <button type="submit" class="px-5 py-2 bg-green-400 cursor-pointer hover:bg-green-300">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
@section('scripts')
<script>
    $(document).on('submit','.loginForm',function(e){
        e.preventDefault()
        $.ajax({
            url:'{{route("auth.login")}}',
            type:"POST",
            data:$(this).serialize(),
            success:function(res){

            }
        })
    })
</script>
@endsection