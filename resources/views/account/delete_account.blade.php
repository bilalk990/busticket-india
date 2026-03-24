@extends('layouts.app')
@section('content')
<main>
<section class="pt-3">
	<div class="container">
		<div class="row g-2 g-lg-4">
            @include('account.partials.side_bar')
            <div class="col-lg-8 col-xl-9">
				<div class="mb-0 d-grid d-lg-none w-100">
					<button class="mb-4 btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
						<i class="fas fa-sliders-h"></i> Menu
					</button>
				</div>
				<div class="border card">
					<div class="card-header border-bottom">
						<h4 class="card-header-title">Delete Account</h4>
					</div>
					<div class="card-body">
						<h6>Before you go...</h6>
						<ul>
                            <li>If you delete your account, you will lose your all data.</li>
							<li>Kindly reach out to Customer Service to request account deletion. </li>
						</ul>
						{{--  <div class="my-4 form-check form-check-md">
							<input class="form-check-input" type="checkbox" value="" id="deleteaccountCheck">
							<label class="form-check-label" for="deleteaccountCheck">Yes, Id like to delete my account</label>
						</div>
						<a href="" class="mb-2 btn btn-success-soft btn-sm mb-sm-0">Keep my account</a>
						<a href="" class="mb-0 btn btn-danger btn-sm">Delete my account</a>  --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</main>
@endsection
