@push('styles')
    <style>
        .blog-sidebar .category-widget .category-list li button {
            position: relative;
            display: block;
            font-size: 16px;
            line-height: 26px;
            color: #93959e;
            font-weight: 500;
            padding-left: 15px;
            background: white;
        }

        .blog-sidebar .category-widget .category-list li button:hover{
            color: #2dbe6c;
        }
    </style>
@endpush

<div class="widget-content">
    <ul class="category-list ">
        <li><a href="{{route('user.loans')}}"><i class="fa fa-indent" aria-hidden="true"></i> Loans </a></li>
        <li class="current"><a href="{{route('user.profile.edit')}}"><i class="fab fa fa-user "></i> Edit Profile</a></li>
        <li><a href="{{route('user.password.change')}}"><i class="fa fa-key" aria-hidden="true"></i> Security </a></li>
        <li><a href="{{route('user.contact')}}"><i class="fa fa-comment" aria-hidden="true"></i> Contact</a></li>
        <li>
            <form method="post" action="{{route('logout')}}">
                @csrf
                <button type="submit"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i> Logout</button>
            </form>
        </li>
    </ul>
</div>