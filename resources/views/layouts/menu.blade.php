<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('users.index')}}">
    <i class="fas fa-users"></i><span>Users</span>
    </a>
</li>
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('posts.index')}}">
    <i class="fas fa-comments"></i><span>Posts</span>
    </a>
</li>
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('roles.index')}}">
    <i class="fas fa-user-tag"></i><span>Roles</span>
    </a>
</li>

