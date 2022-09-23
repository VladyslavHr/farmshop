@extends('admin.layouts.adminapp')

@section('page-title', 'Адміністрація')

@section('content')

<!-- Account profile page content-->
<div class="container-xl p-5">
    <!-- Tab bar navigation-->
    {{-- <mwc-tab-bar style="margin-bottom: -1px" activeindex="2">
        <mwc-tab label="Billing" icon="account_balance" stacked="" onclick='location.href="app-account-billing.html"'></mwc-tab>
        <mwc-tab label="Notifications" icon="notifications" stacked="" onclick='location.href="app-account-notifications.html"'></mwc-tab>
        <mwc-tab label="Profile" icon="person" stacked="" onclick='location.href="app-account-profile.html"'></mwc-tab>
        <mwc-tab label="Security" icon="security" stacked="" onclick='location.href="app-account-security.html"'></mwc-tab>
    </mwc-tab-bar> --}}
    <!-- Divider-->
    <hr class="mt-0 mb-5" />
    <!-- Profile content row-->
    <div class="row gx-5">
        <h1>Ласкаво просимо до Адміністрації</h1>
    </div>
</div>

@endsection
