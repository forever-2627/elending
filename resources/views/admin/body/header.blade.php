<nav class="navbar">
	<a href="#" class="sidebar-toggler">
		<i data-feather="menu"></i>
	</a>
	<div class="navbar-content">
		<ul class="navbar-nav gap-2">
            <li class="nav-item dropdown">
                @php
                    $unread_messages = \App\Models\Message::where(['read' => 0])->get();
                @endphp

                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="message-circle"></i>
                    @if($unread_messages->count() > 0)
                        <div class="indicator">
                            <div class="circle"></div>
                        </div>
                    @endif
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>{{count($unread_messages)}} New Notifications</p>
                    </div>
                    <div class="p-1">
                        @foreach($unread_messages as $unread_message)
                            <a href="{{route('staff.messages.view', $unread_message->id)}}" class="dropdown-item d-flex align-items-center py-2">
                                <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                    <i class="icon-sm text-white" data-feather="alert-circle"></i>
                                </div>
                                <div class="flex-grow-1 me-2">
                                    <p>{{$unread_message->title}}</p>
                                    <p class="tx-12 text-muted">{{$unread_message->received_time}}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="{{route('staff.messages')}}">View all</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown">
                @php
                    $unread_messages = \App\Models\Message::where(['read' => 0])->get();
                @endphp

                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    @if($unread_messages->count() > 0)
                        <div class="indicator">
                            <div class="circle"></div>
                        </div>
                    @endif
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>{{count($unread_messages)}} New Notifications</p>
                    </div>
                    <div class="p-1">
                        @foreach($unread_messages as $unread_message)
                            <a href="{{route('staff.messages.view', $unread_message->id)}}" class="dropdown-item d-flex align-items-center py-2">
                                <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                    <i class="icon-sm text-white" data-feather="alert-circle"></i>
                                </div>
                                <div class="flex-grow-1 me-2">
                                    <p>{{$unread_message->title}}</p>
                                    <p class="tx-12 text-muted">{{$unread_message->received_time}}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="{{route('staff.messages')}}">View all</a>
                    </div>
                </div>
            </li>

			@php
				$id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
			@endphp


			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img class="wd-30 ht-30 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
				</a>
				<div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
					<div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
						<div class="mb-3">
							<img class="wd-80 ht-80 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="">
						</div>
						<div class="text-center">
							<p class="tx-16 fw-bolder">{{ $profileData->name }}</p>
							<p class="tx-12 text-muted">{{ $profileData->email }}</p>
						</div>
					</div>
					<ul class="list-unstyled p-1">
						<li class="dropdown-item py-2">
							<form method="POST" action="{{ route('logout') }}">
								@csrf
								<a href="{{route('logout')}}" class="text-body ms-0" onclick="event.preventDefault();this.closest('form').submit();">
									<i class="me-2 icon-md" data-feather="log-out"></i>
									<span>Log Out</span>
								</a>
							</form>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</nav>