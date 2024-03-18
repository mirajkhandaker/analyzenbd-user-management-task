@if($routeName == 'deleted-user.index')
    <form action="{{route('deleted-user.destroy', $user->id)}}" method="post">
        @else
            <form action="{{route('users.destroy', $user->id)}}" method="post">
                @endif
                @method('delete')
                @csrf
                @if($routeName != 'users.show' && $routeName != 'deleted-user.index')
                    <a class="btn btn-info btn-sm" href="{{route('users.show',$user->id)}}">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                @endif
                @if($routeName != 'deleted-user.index')
                    <a class="btn btn-warning btn-sm" href="{{route('users.edit',$user->id)}}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                @endif
                @if($routeName == 'deleted-user.index')
                    <a class="btn btn-warning btn-sm restore" href="{{route('deleted-user.restore',$user->id)}}">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                    </a>
                @endif
                @if(auth()->id() != $user->id)
                    <button type="submit" class="btn btn-danger btn-sm delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endif
            </form>
