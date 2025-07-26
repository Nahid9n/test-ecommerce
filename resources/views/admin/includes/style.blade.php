

<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="{{asset($setting->favicon)}}" />

<!-- BOOTSTRAP CSS -->
<link id="style" href="{{asset('/')}}admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

<!-- STYLE CSS -->
<link href="{{asset('/')}}admin/assets/css/style.css" rel="stylesheet" />
<link href="{{asset('/')}}admin/assets/css/skin-modes.css" rel="stylesheet" />



<!--- FONT-ICONS CSS -->
<link href="{{asset('/')}}admin/assets/plugins/icons/icons.css" rel="stylesheet" />

<!-- INTERNAL Switcher css -->
<link href="{{asset('/')}}admin/assets/switcher/css/switcher.css" rel="stylesheet">
<link href="{{asset('/')}}admin/assets/switcher/demo.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .info-container {
        position: relative;
        display: inline-block;
    }

    .info-button {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 16px;
    }

    .details-box {
        display: none;
        position: absolute;
        bottom: 100%; /* Position the box above the button */
        left: 10%;
        transform: translateX(-50%);
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 4px;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        white-space: nowrap;
        z-index: 10000;
    }

    .info-container:hover .details-box {
        display: block;
    }
</style>
