<nav class="sidebar">
	<div class="sidebar-header">
		<a href="#" class="sidebar-brand">
			ISMB<span class="fw-bold">ADMIN</span>
		</a>
		<div class="sidebar-toggler not-active">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<div class="sidebar-body">
		<ul class="nav">
			@if(auth()->user()->role_id == config('constants.roles.admin_role_id'))
				<li class="nav-item nav-category">Admin</li>
				<li class="nav-item">
					<a href="{{route('admin.dashboard')}}" class="nav-link">
						<i class="link-icon" data-feather="box"></i>
						<span class="link-title">Dashboard</span>
					</a>
				</li>
			@endif
			<li class="nav-item nav-category">Main</li>
			<li class="nav-item">
				<a href="{{route('staff.users')}}" class="nav-link">
					<i class="link-icon" data-feather="users"></i>
					<span class="link-title">User Management</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-bs-toggle="collapse" href="#loans" role="button" aria-expanded="false"
				   aria-controls="emails">
					<i class="link-icon" data-feather="dollar-sign"></i>
					<span class="link-title">Loan Management</span>
					<i class="link-arrow" data-feather="chevron-down"></i>
				</a>
				<div class="collapse" id="loans">
					<ul class="nav sub-menu">
						<li class="nav-item">
							<a href="{{route('staff.loans', ['state' => 'all'])}}" class="nav-link">All Loans</a>
						</li>
						<li class="nav-item">
							<a href="{{route('staff.loans', ['state' => 'active'])}}" class="nav-link">Active Loans</a>
						</li>
						<li class="nav-item">
							<a href="{{route('staff.loans', ['state' => 'repaid'])}}" class="nav-link">Repaid Loans</a>
						</li>
						<li class="nav-item">
							<a href="{{route('staff.loans', ['state' => 'bad'])}}" class="nav-link">Bad Loans</a>
						</li>
						<li class="nav-item">
							<a href="{{route('staff.loans.requested')}}" class="nav-link">Requested Loans</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a href="{{route('staff.repayments')}}" class="nav-link">
					<i class="link-icon" data-feather="credit-card"></i>
					<span class="link-title">Repayments</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('staff.calendar')}}" class="nav-link">
					<span class="fal fa-calendar"></span>
					<span class="link-title ms-3">Repayments Due</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('staff.messages')}}" class="nav-link">
					<i class="link-icon" data-feather="message-circle"></i>
					<span class="link-title">Messages</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('staff.notifications')}}" class="nav-link">
					<i class="link-icon" data-feather="bell"></i>
					<span class="link-title">Notifications</span>
				</a>
			</li>
			<li class="nav-item nav-category">Others</li>
			<li class="nav-item">
				<a href="{{route('staff.calculator')}}" class="nav-link">
					<span class="fal fa-calculator"></span>
					<span class="link-title ms-3">Calculator</span>
				</a>
			</li>
			@if(auth()->user()->role_id == config('constants.roles.admin_role_id'))
				<li class="nav-item">
					<a href="{{route('admin.settings')}}" class="nav-link">
						<i class="link-icon" data-feather="settings"></i>
						<span class="link-title">Settings</span>
					</a>
				</li>
			@endif
		</ul>
	</div>
</nav>
@push('script')

@endpush