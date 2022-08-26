<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
    <img src="{{ public_path('image_2022_05_25T04_13_19_945Z.png') }}">
    <style>
        * {
            font-family: "Montserrat", sans-serif;
        }
        body {
            background: #fafbfd;
        }
        p {
            font-size: 14px;
            font-weight: 400;
        }
        i {
            font-size: 17px;
        }
        a {
            text-decoration: none;
            transition: all 300ms ease-in-out;
        }
        .pr-0 {
            padding-right: 0;
        }
        .content-wrapper {
            position: relative;
        }
        /* input:required:invalid {
          border-color: #c00000;
        } */
        /* .form-control:invalid:focus{
          border-color:#d52626;
        } */
        label.input-has-value {
            color: red;
        }
        /* .was-validated .form-select:invalid:focus, .form-select.is-invalid:focus {
            border-color: #dc3545;
            -webkit-box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25); }

        .was-validated .form-check-input:invalid, .form-check-input.is-invalid {
          border-color: #dc3545; }
          .was-validated .form-check-input:invalid:checked, .form-check-input.is-invalid:checked {
            background-color: #dc3545; }
          .was-validated .form-check-input:invalid:focus, .form-check-input.is-invalid:focus{
            -webkit-box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25); }
          .was-validated .form-check-input:invalid ~ .form-check-label, .form-check-input.is-invalid ~ .form-check-label {
            color: #dc3545; } */
        /* Login CSS */
        .admin_error {
            width: 26%;
            margin: 0 auto;
            color: #d52222;
            background: #e7edfe;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            align-items: center;
        }
        .admin_error p,
        .block-details ul {
            margin: 0;
        }
        .content-center {
            min-height: 100vh;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            text-align: center;
            background: linear-gradient(270deg, #691b7c, #5f5bb6, #4047a3, #453e96);
            background-size: 800% 800%;
            -webkit-animation: LoginBg 30s ease infinite;
            -moz-animation: LoginBg 30s ease infinite;
            animation: LoginBg 30s ease infinite;
            /*padding: 30px 15px;*/
            /* background: #1d5bb4; */
            /* position: relative; */
        }

        @-webkit-keyframes LoginBg {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        @-moz-keyframes LoginBg {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        @keyframes LoginBg {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        .login-wrap {
            /* width: 350px; */
            margin: 0 auto;
            /*-ms-transform: translateY(3%);*/
            /*transform: translateY(3%);*/
            /*left: 50%;*/
            /* position: absolute; */
        }
        .login-wrap article img {
            /* width: 310px; */
            margin-bottom: 45px;
        }
        .sign-in-title {
            font-size: 28px;
            line-height: 1.06;
            letter-spacing: 1px;
            color: #7ea4db;
            font-weight: 600;
        }
        .sign-in-subtitle {
            font-weight: 500;
            font-size: 14px;
            line-height: 1.2;
            margin-bottom: 30px;
            color: #79a8eb;
        }
        .login-check input {
            margin-left: 0 !important;
        }
        .stbtn-login {
            color: #fff;
            margin-top: 20px;
            width: 100%;
            background: #e352b2;
            border: 1px solid #ea4fb5;
        }
        .btn-login,
        .stbtn-login:hover {
            color: #ffe5f6;
            background: #e14cae;
        }
        .form-block-wrap {
            -webkit-box-shadow: 0 5px 10px rgba(160, 163, 189, 0.1);
            box-shadow: 0 5px 10px rgba(160, 163, 189, 0.1);
            /* border-radius: 10px; */
            padding: 40px 40px 56px;
            background-color: #fff;
            text-align: left;
        }
        /* .st-loginwrap{
          background-color:#da30a0;
        } */
        .st-loginwrap input {
            /* border: 1px solid #fff; */
            font-size: 0.8125rem;
            /* background: #fff; */
            border-radius: 4px;
        }
        .st-loginwrap label {
            color: #fff;
        }
        .forget-link {
            color: #ffa5e0;
            transition: 300ms ease-in-out;
        }
        .forget-link:hover {
            text-decoration: underline;
            color: #ed86c9;
        }
        /* End of Login CSS */
        .modal-content {
            background: #fff;
            border: none;
        }
        .modal-header {
            background: #eff6ff;
        }
        .btn-ctm-close,
        .btn-ctm-save {
            transition: all 300ms ease-in-out;
        }
        .btn-ctm-close,
        .btn-ctm-save,
        .btn-ctm-close:hover,
        .btn-ctm-save:hover {
            color: #ffffff;
        }
        .btn-ctm-close {
            background: #d931a1;
            border-color: #d931a1;
        }
        .btn-ctm-save {
            background: #2c72ce;
            border-color: #2365bb;
        }
        .btn-ctm-close:hover {
            background: #bf218b;
            border-color: #d931a1;
        }
        .btn-ctm-save:hover {
            background: #2866b7;
            border-color: #2365bb;
        }
        .table th,
        .table td {
            padding: 14px;
            font-family: "Montserrat", sans-serif !important;
        }
        .table thead th {
            font-weight: 500 !important;
            font-size: 16px;
            background: #fbfdff;
        }
        .ctmtable-striped > tbody > tr:nth-of-type(2n + 1) {
            background: rgba(255, 255, 255, 1);
        }
        .table-striped,
        .ctmtable-striped > tbody > tr:nth-of-type(2n) {
            background: #fafbfd;
        }
        .table-card tr a,
        .ctmtable-striped tr a {
            color: #212529;
            text-decoration: none;
        }
        .table-card tr a:hover {
            color: #5583c4;
        }
        .table-card tr a {
            transition: all 200ms ease-in-out;
        }
        .light-blue,
        .light-blue {
            background: linear-gradient(to right, #3054b6, #7c53b2);
        }
        .navbar .navbar-brand-wrapper {
            background: #3557b3;
        }
        .td-pblock input:checked {
            background-color: #23b679;
            border-color: #24ae75;
        }
        .td-ablock input:checked {
            background-color: #c91919;
            border-color: #bc1414;
        }
        .present {
            color: rgb(35, 182, 121);
        }
        .absent {
            /* color: rgb(201, 25, 25); */
            display: inline-block;
            padding: 5px;
            background: #cd3535;
            border-radius: 2px;
            color: #fff;
        }
        .td-pblock input:focus {
            box-shadow: 0 0 0 0.25rem rgb(35, 182, 121, 0.25);
        }
        .td-ablock input:focus {
            box-shadow: 0 0 0 0.25rem rgba(202, 14, 14, 0.25);
        }
        .light-blue {
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.05);
            -webkit-box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.05);
        }
        .sidebar .nav .nav-item .nav-link .menu-title {
            font-weight: 500;
        }
        .sidebar .nav.sub-menu .nav-item .nav-link {
            color: #d9e6f7;
        }
        .sidebar .nav .nav-item:hover,
        .hover-open:hover {
            background: #395ab3;
        }
        .sidebar
        .nav:not(.sub-menu)
        > .nav-item:hover:not(.nav-category):not(.nav-profile)
        > .nav-link {
            color: #dcecff;
        }
        .sidebar .nav.sub-menu .nav-item .nav-link:hover {
            color: #97ace3;
        }
        .sidebar {
            background: linear-gradient(to right, #4366bc, #4665bc);
        }
        .sidebar .nav .nav-item .nav-link {
            color: #dcecff;
        }
        .count-indicator {
            color: #fff !important;
        }
        .font-weight-normal,
        .card-body {
            font-family: "Montserrat", sans-serif;
        }
        .card-body h2 {
            font-weight: 600;
        }
        .nav-title {
            margin-left: auto;
            margin-right: auto;
        }
        .navbar .navbar-menu-wrapper .navbar-toggler {
            color: #fff;
        }
        .navbar
        .navbar-menu-wrapper
        .navbar-nav
        .nav-item.dropdown
        .dropdown-toggle::after {
            color: #d6bfee;
        }

        .nav-title h2 {
            color: #ffffff;
            /* color:#505458; */
            font-size: 26px;
            margin: 0;
        }
        .nav-search {
            background: rgba(239, 246, 255, 0.04);
            /* background: #e0edff; */
            border-radius: 4px;
        }
        .nav-search input {
            color: #c6c1f1;
        }
        /* Student Profile Page CSS */
        .card-wrap,
        .card-wrapper {
            background-color: #ffffff;
            border-radius: 6px;
            width: 100%;
        }
        .card-wrap,
        .rightblock {
            box-shadow: 0px 6px 8px 1px rgba(0, 0, 0, 0.03);
            -webkit-box-shadow: 0px 6px 8px 1px rgba(0, 0, 0, 0.03);
            -moz-box-shadow: 0px 6px 8px 1px rgba(0, 0, 0, 0.03);
        }
        /* .card-wrap{
          padding: 15px;
        } */
        .car-wrap,
        .table-card,
        .card-wrapper {
            box-shadow: 0px 1px 12px 1px rgba(0, 0, 0, 0.05);
            -webkit-box-shadow: 0px 1px 12px 1px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 0px 1px 12px 1px rgba(0, 0, 0, 0.05);
        }
        .card-wrap .nav-tabs {
            background: linear-gradient(to right, #4254b5, #a942a9);
            border-top-right-radius: 6px;
            border-top-left-radius: 6px;
        }
        .card-wrap .nav-tabs li button:hover {
            background: linear-gradient(to right, #553fa5, #5540a6);
            /* border-color: #ebedf2 #ebedf2 #ebedf2; */
            border-color: rgba(212, 210, 210, 0.1);
            color: #f3f7fe;
        }

        /* .avatar-block{
            width: 96px;
            height: 96px;
            margin-top:22px;
            margin-bottom: 15px;
            margin-left:auto;
            margin-right: auto;
        }
        .avatar-block img{
            border: 5px solid rgba(146, 183, 230, 0.2);
            border-radius: 100%;
            width:96px;
            height: 96px;
        }
        .profile-block h4, .rollno{
            text-align: center;
        }
        .profile-block h4{
            font-weight: 600;
        }
        .rollno{
            font-weight: 500;
        }
        .profile-block h4, .rollno{
            color: #2460b5;
        }
        .profile-block p{
            margin-bottom:10px;
        }
        .st-subdetails{
          margin-top: 15px;
          padding: 10px 15px;
          background: #fbfdff;
          border-bottom-left-radius: 6px;
          border-bottom-right-radius: 6px;
        }
        .st-subdetails p{
            display: flex;
            margin:0;
            line-height: 28px;
        }
        .st-subdetails p a{
          color:#3e4b5b;
          display:flex;
        } */
        .uershort-desc {
            width: 48%;
        }
        .st-subdetails {
            /* margin-top: 15px; */
            padding: 15px 15px;
            background: #fbfdff;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
        }
        .st-subdetails p {
            display: flex;
            margin: 0;
            line-height: 30px;
        }
        .st-subdetails p a,
        .v-list li a {
            color: #3e4b5b;
            display: flex;
        }
        .avatar-block {
            width: 110px;
            height: 110px;
            margin: 20px;
            /* margin: 25px auto; */
        }
        .avatar-block img {
            border: 5px solid rgba(230, 230, 230, 0.3);
            border-radius: 100%;
            width: 110px;
            height: 110px;
        }
        /* .profile-block h4, .rollno{
            text-align: center;
        } */
        .profile-block h4 {
            font-weight: 600;
        }
        .rollno {
            font-weight: 500;
        }
        .profile-block h4,
        .rollno {
            color: #2460b5;
        }
        .profile-block p {
            margin-bottom: 10px;
        }
        /* .st-subdetails{
            margin-top:20px;
        } */
        .st-subdetails p {
            display: flex;
        }
        .profile-block {
            background: #eff6ff;
            width: 100%;
            display: flex;
            align-items: center;
        }
        .stblock-action {
            margin: 0;
        }
        .stblock-action li {
            display: inline-block;
            /* margin-left:20px; */
        }
        .stblock-action li a {
            display: block;
            background: #2460b5;
            color: #fff;
            padding: 7px 18px;
            border-radius: 25px;
        }
        .stblock-action li a:hover,
        .block-details ul li a:hover,
        .error div a:hover {
            color: #c0d4ff;
            background: #144ea0;
        }
        .emergency-contact {
            background: #eff6ff;
            color: #2460b5;
            padding: 8px;
            border-radius: 4px;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .emergency-contact h4 {
            margin: 0;
        }
        .st-subdetails p span {
            margin-right: 8px;
        }
        .st-subdetails i {
            color: #2f68b9;
        }
        /* End of Added */
        .st-subdetails p a:hover,
        .ctmtable-striped tr a:hover,
        .modal-file a:hover,
        .v-list li a:hover {
            color: #2460b5;
        }
        .modal-file label {
            margin-bottom: 20px;
        }
        .modal-file h4 {
            font-weight: normal;
            font-size: 16px;
            line-height: 28px;
        }
        .modal-file a,
        .modal-file h4 {
            color: #383e44;
        }
        .modal-file a {
            margin: 15px 0px 20px 0px;
            display: inline-block;
        }
        .video-wrap h4 {
            background: #d931a1;
            padding: 7px 10px;
            border-radius: 2px;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .block-heading {
            margin-bottom: 25px;
        }
        .page-title {
            color: #212529;
            font-size: 22px;
        }
        .heading-only {
            margin-top: 35px;
        }
        .attendance-wrap table tr th,
        .attendance-wrap table tr td {
            border: 1px solid #ebedf2;
        }
        .present {
            color: rgb(35, 182, 121);
        }
        /* .absent{
            color:rgb(201, 25, 25);
        } */
        .footer {
            background: #fff;
            border: 1px solid #ebedf2;
            margin-top: 30px;
        }
        .block-header {
            /* background: #f9fbff; */
            background-color: #f3f7fe;
            display: flex;
            align-items: center;
            border-top-right-radius: 4px;
            border-top-left-radius: 4px;
        }
        .block-header h3,
        .block-header h4,
        .block-header h5 {
            margin: 0;
        }
        .card-wrap .nav-tabs li button {
            font-size: 16px;
            font-weight: 500;
            color: #f3f7fe;
        }
        .tab-content {
            padding-left: 1.2rem;
            padding-right: 1.2rem;
        }
        .card-wrapper,
        .profile-block,
        .card-wrapper-plain {
            margin-top: 20px;
            border-radius: 6px;
        }
        .profile-block {
            background: #eff6ff;
            width: 100%;
        }
        .profile-block h4,
        .rollno {
            color: #2460b5;
        }
        .profile-block h4 {
            font-weight: 600;
        }
        .profile-block p {
            margin-bottom: 10px;
        }
        /* .st-subdetails {
          margin-top: 15px;
          padding: 10px 15px;
          background: #fbfdff;
          border-bottom-left-radius: 6px;
          border-bottom-right-radius: 6px;
        } */
        .block-header h3 {
            font-size: 22px;
            padding: 10px 20px;
            margin: 0;
        }
        .dblock {
            display: block;
        }
        .dblock h3 {
            padding-bottom: 5px;
        }
        .dblock p {
            padding: 0px 20px 10px 20px;
            margin: 0;
            color: #838486;
        }
        .block-header h4,
        .block-header h5 {
            padding: 10px 20px;
        }
        .block-header .tbl-date {
            padding: 10px 10px 10px 20px;
        }
        .tbl-date {
            margin-left: auto;
            display: flex;
            align-items: center;
        }
        .tbl-date i {
            background: #e5eaf2;
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
            font-size: 18px;
            padding: 8px 10px;
        }
        .tbl-date input {
            border: 1px solid #f1f6fe;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
            padding: 10px 8px;
            font-size: 14px;
        }
        .mt-2x {
            margin-top: 1.5rem;
        }
        .sidebar .sub-collapse .sub-menu li {
            padding: 0.5rem 2rem 0.75rem 1rem !important;
        }
        .sub-collapse .sub-menu {
            margin-left: 10px;
        }
        .collapse2 {
            margin-left: 15px;
        }
        .lesson-head h1 {
            font-size: 1.6rem;
            padding: 10px 15px;
        }
        .lesson-head h1,
        .lesson-head h3,
        .ghead h3 {
            padding: 10px 15px;
        }
        .lesson-head h3,
        .ghead h3 {
            font-size: 1.3rem;
        }
        .lesson-head h1,
        .lesson-head h3,
        .ghead h3 {
            margin: 0;
        }
        .lesson-head {
            background: #f3f7fe;
            border-top-right-radius: 4px;
            border-top-left-radius: 4px;
        }
        .lesson-head p {
            color: #9f9f9f;
            margin: 0;
        }
        /* Progress Bar CSS */
        .countwrapper {
            width: 150px;
            height: 150px;
            position: relative;
            margin: 0 auto;
        }
        svg {
            transform: rotate(-90deg);
        }
        .inner-outline,
        .outer-outline {
            stroke: rgba(0, 0, 0, 0.15);
            stroke-width: 2px;
        }
        .inner-inline,
        .outer-inline {
            stroke: rgba(0, 0, 0, 0.05);
            stroke-width: 2px;
        }
        .inner-bg {
            stroke: rgba(255, 206, 155, 0.8);
            stroke-width: 14px;
        }
        .outer-bg {
            stroke: rgba(214, 231, 255, 0.5);
            stroke-width: 14px;
        }
        #outer {
            stroke-dasharray: 565.48667765;
            stroke-dashoffset: 56.54866776;
            -webkit-animation: outerAnim 2s linear forwards;
            animation: outerAnim 2s linear forwards;
            stroke: #e82796;
            stroke-width: 14px;
            stroke-linecap: round;
        }
        #inner {
            stroke-dasharray: 439.8229715;
            stroke-dashoffset: 0;
            -webkit-animation: innerAnim 2s linear forwards;
            animation: innerAnim 2s linear forwards;
            stroke: #ff6f2c;
            stroke-width: 14px;
            stroke-linecap: round;
        }
        .text-circle {
            position: absolute;
            height: 110px;
            width: 110px;
            border-radius: 55px;
            top: 15px;
            left: 26px;
            display: table;
            color: #444;
        }
        .text-circle .circle-text {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }
        .text-circle .circle-text p {
            margin: 0;
            padding: 0;
            line-height: 1.4em;
        }
        .text-circle .circle-text span {
            font-size: 2em;
            line-height: 0.8em;
            font-weight: 700;
        }
        .text-circle .circle-text .time-remain {
            font-weight: 400;
            font-size: 0.7em;
            color: #e82796;
        }
        .text-circle .circle-text .jobs-remain {
            margin-top: 4px;
            font-weight: 600;
        }
        .text-circle:hover {
            color: #333;
        }
        @-webkit-keyframes outerAnim {
            from {
                stroke-dashoffset: 565.48667765;
            }
            to {
                stroke-dashoffset: 56.54866776;
            }
        }
        @keyframes outerAnim {
            from {
                stroke-dashoffset: 565.48667765;
            }
            to {
                stroke-dashoffset: 56.54866776;
            }
        }
        @-webkit-keyframes innerAnim {
            to {
                stroke-dashoffset: -113.50270232;
            }
        }
        @keyframes innerAnim {
            to {
                stroke-dashoffset: -113.50270232;
            }
        }
        /* End of Total Availabel Time CSS */
        .border-block .class-link-block {
            background: #fbfdff;
        }
        .class-link-block h6 {
            margin-left: 15px;
            font-weight: bold;
        }
        .class-link i {
            font-size: 46px;
            color: #4565bc;
        }
        .block-details ul li a {
            color: #fbfdff;
            background: #2460b5;
            padding: 3px 10px;
            display: block;
            border-radius: 25px;
        }
        .block-details ul li a,
        .error div a {
            color: #fbfdff;
            background: #2460b5;
        }
        .error div a {
            padding: 5px 10px;
            border-radius: 25px;
            display: inline-block;
            margin-top: 1.5rem;
        }
        .error p {
            margin-bottom: 8px;
        }
        .block-details ul,
        .class-link-block h6 {
            display: inline;
        }
        .block-details ul li {
            display: inline-block;
        }
        .tbl-meeting tbody tr,
        .tbl-meeting tbody tr td,
        .tbl-meeting tbody tr th {
            border-bottom: none;
            padding-bottom: 0;
        }
        .rightblock {
            border-radius: 4px;
        }
        .rightblock-body,
        .block-body {
            background: #fff;
            border-bottom-right-radius: 4px;
            border-bottom-left-radius: 4px;
            padding: 15px 15px;
        }
        .q-block img {
            border: 1px solid #dde1e9;
            width: 100%;
            border-radius: 4px;
            padding: 5px;
        }
        .q-block h4 {
            margin: 20px 0px 12px 0px;
            line-height: 28px;
        }
        /* .ans-block{
          display:flex;
        } */
        .form-select:focus {
            box-shadow: none;
        }
        .ans-block .form-check label {
            margin-left: 1.5rem;
        }
        .ans-block .form-check input,
        .form-check .form-check-input {
            margin-left: 0;
        }
        .ans-block .form-check {
            margin-top: 0;
            margin-bottom: 0;
        }
        .ans-num {
            font-weight: 600;
            margin-right: 5px;
        }
        .ans-block div {
            margin-right: 20px;
            display: inline-block;
        }
        .ans-block div:last-child {
            margin-right: 0;
        }
        .btn-next {
            background: #346bbf;
            color: #fff;
            padding: 10px 30px;
            border-radius: 4px;
            border: 1px solid #3364ad;
            margin-top: 25px;
            font-weight: 500;
        }
        .btn-next:hover {
            transition: all 300ms ease-in-out;
            background: #3364ad;
        }
        .markswrap p:last-child {
            float: right;
        }
        .markswrap p {
            display: inline-block;
            margin-top: 10px;
            margin-bottom: 0;
            color: #9f9f9f;
        }
        .markswrap p span {
            font-weight: 600;
            margin-right: 10px;
        }
        .correct-ans,
        .user-ans {
            display: inline-block;
            margin-top: 30px;
        }
        .user-ans {
            float: right;
        }
        .correct-ans p,
        .user-ans p {
            font-weight: 600;
            color: #343a40;
        }
        .correct-ans span {
            background: #18913c;
        }
        .user-ans span {
            background: #c42727;
        }
        .correct-ans span,
        .user-ans span {
            padding: 4px 7px;
            border-radius: 4px;
            overflow: hidden;
            color: #fff;
            font-weight: 600;
            margin-left: 5px;
        }
        /* Enrollment Form CSS */
        .enrollform-head {
            text-align: center;
        }
        .enrollform-head h2 {
            font-weight: 600;
        }
        .enrollform-head ul {
            margin: 10px 0px;
            padding: 0;
        }
        .enrollform-head ul li {
            display: inline-block;
            padding-left: 7px;
            padding-right: 7px;
            border-right: 1px solid #333;
            font-size: 18px;
            font-weight: 500;
            padding-top: 0;
        }
        .enrollform-head ul li:last-child {
            padding-right: 0;
            border-right: 0;
        }
        .ghead {
            background: linear-gradient(to right, #326cbf, #d933a2);
            color: #fff;
            border-top-right-radius: 4px;
            border-top-left-radius: 4px;
        }
        .ghead h3 {
            display: inline-block;
        }
        .enrolldate {
            float: right;
            margin: 10px 10px 10px;
            display: flex;
            align-items: center;
        }
        .enrolldate i {
            background: #981f8c;
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
            font-size: 18px;
            display: inline-block;
            padding: 6px 10px;
            margin-left: 15px;
        }
        .enrolldate input {
            padding: 6px 10px;
        }
        .clearfix {
            clear: both;
        }
        /* .gender-wrap{
          display:flex;
          align-items: center;
        } */
        .gender-wrap div {
            display: inline-block;
            margin-left: 5px;
        }
        .block-label {
            display: block;
        }
        .gender-wrap input[type="radio"],
        .accept-check input[type="checkbox"] {
            margin-left: 0;
        }
        .block-body ol {
            padding-left: 2rem;
        }
        .block-body ol li {
            margin-bottom: 15px;
        }
        .block-body ol li,
        .body-block .accept-check label,
        .decleration p {
            font-size: 1rem;
        }
        .accept-check label {
            font-weight: 600;
            font-size: 1rem !important;
        }
        .block-body select {
            padding: 0.64rem 0.375rem;
        }
        .st-image input {
            margin-top: 20px;
            font-size: 13px;
            overflow: hidden;
        }
        .cred,
        .form-alert {
            color: #d52626;
        }
        .form-alert {
            margin-top: 10px;
        }
        .block-hide {
            display: none;
        }
        .block-show {
            display: block;
        }
        .red-block,
        .red-block p {
            color: #d52626;
        }
        .red-block input,
        .red-block select {
            border: 1px solid #d52626;
        }
        .required:after {
            content: "*";
            color: red;
        }
        /* Technical Exam CSS */
        .checks-wrap ul li {
            margin-right: 15px;
            display: inline-block;
        }
        .checks-wrap ul li div {
            display: flex;
            align-items: center;
            margin-top: 0px;
        }
        .checks-wrap h5,
        .exam-details-lblock h5 {
            margin: 20px 0px 10px 0px;
        }
        .physical-wrap ul,
        .v-list ul {
            margin: 0;
            padding: 0;
        }
        .physical-wrap ul li,
        .physical-exam {
            display: block;
            background: #fafbfd;
            border-radius: 4px;
            padding: 15px;
        }
        .physical-wrap ul li div p {
            margin-bottom: 0px;
        }
        .physical-wrap ul li {
            margin-bottom: 15px;
        }
        .physical-wrap ul li a {
            color: #212529;
        }
        .physical-wrap ul li div {
            margin: 0;
        }
        .examtime-wrap {
            margin-top: 20px;
        }
        .examtime-wrap button {
            background: #4565bc;
            border: 1px solid #3a58ab;
            border-radius: 4px;
            color: #fff;
            padding: 8px;
            margin-right: 15px;
            margin-bottom: 20px;
        }
        .maintime-wrap h5 {
            margin: 20px 0px;
        }
        .maintime-wrap .hasDatepicker,
        .maintime-wrap .ui-datepicker-inline {
            width: 100%;
        }
        .ui-datepicker td span,
        .maintime-wrap table td a {
            padding: 0.6em 0.2em !important;
        }
        .ui-widget-header {
            border: 1px solid #f2f4f8;
            background: #fafbfd;
            color: #333333;
            font-weight: bold;
        }
        .ui-widget.ui-widget-content {
            border: 1px solid #f2f4f8 !important;
        }
        .ui-widget-header,
        .ui-state-default,
        .ui-widget-content .ui-state-default,
        .ui-widget-header .ui-state-default,
        .ui-button,
        html .ui-button.ui-state-disabled:hover,
        html .ui-button.ui-state-disabled:active {
            border: 1px solid #ebf0fa !important;
            background: #fafbfd !important;
            font-weight: normal;
            color: #454545;
        }
        /* Technical Exam Details */
        .physical-exam {
            margin-bottom: 1.2rem;
        }
        .physical-exam h5 {
            margin-bottom: 1rem;
        }
        .physical-exam p {
            margin-left: 1.8rem;
            margin-bottom: 0;
        }
        .d-time p {
            margin-bottom: 0;
            line-height: 30px;
        }

        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            overflow-x: unset;
        }

        .sign-in-title {
            font-size: 14px;
            color: #979ad1;
        }
        .login-wrap article img {
            margin-bottom: 20px;
        }
        article {
            padding: 25px 0px;
            margin: 0 auto;
            background-image: linear-gradient(to right, #3256af, #6e1678);
        }
        .logo-image {
            width: 20%;
            margin: 0 auto;
        }
        .st-loginwrap {
            width: 26%;
            text-align: center;
            display: inline-block;
            padding: 0px;
            padding-bottom: 30px;
            /*margin: 400px auto;*/
            margin: 30px auto;
            border-radius: 6px;
        }
        .st-loginwrap .signIn-heading {
            color: white;
            padding: 15px;
            font-size: 28px;
            text-align: left;
            border-radius: 6px 6px 0px 0px;
            margin-bottom: 30px;
            background-image: linear-gradient(to right, #3256af, #6e1678);
        }
        .st-loginwrap div {
            padding: 0px 30px;
            text-align: left;
            margin-bottom: 20px !important;
        }
        .st-loginwrap label {
            color: black;
            font-weight: 500;
        }
        .st-loginwrap input {
            padding: 10px;
            background: #f5f8ff;
            border: 1px solid #e6ecf9;
        }
        .st-loginwrap .form-check-input {
            transform: scale(0.5);
        }
        .st-loginwrap .form-check-label {
            line-height: 2;
        }
        .st-loginwrap input::placeholder {
            color: #becff3;
        }
        .st-loginwrap .mt-2 {
            text-align: center;
            margin-bottom: 0px !important;
            padding-bottom: 0px !important;
        }
        .st-loginwrap .mt-2 a {
            color: #da2a2a;
            font-size: 15px;
            font-weight: 500;
        }
        .st-loginwrap .btn-login {
            padding: 10px 65px;
            color: white;
            font-weight: 500 !important;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;
            background: #2c51b8;
            font-family: "Montserrat", sans-serif;
        }
        .st-loginwrap .btn-login:hover {
            color: rgb(171, 179, 247);
            background: #0837b9;
        }
        .st-loginwrap .change {
            color: black;
            font-size: 13px;
            font-weight: 500;
            border-bottom: 1px solid #ede0e0;
            padding-bottom: 20px;
            margin: 5px 15px 20px 15px;
        }
        .st-loginwrap .enquiry {
            color: black;
            padding: 0px 30px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 0px;
        }
        .st-loginwrap .enquiry a {
            color: #3366cc;
            font-weight: 600;
        }
        .v-list ul li,
        .block-details ul li {
            list-style: none;
        }
        .v-list ul li a {
            display: flex;
        }
        .v-list ul li a i {
            font-size: 14px;
            color: #d2d5da;
        }
        .border-block {
            border: 1px solid #edf3fb;
            border-radius: 4px;
        }
        .subline {
            color: #9d9ea1;
            margin-top: 0.4em;
        }
        .btn-100 button {
            width: 100%;
            font-size: 16px;
        }
        .btn-blue {
            background: #5070c9;
            border: 1px solid #415fb2;
            color: #fff;
            font-weight: normal;
        }
        .btn-blue:hover {
            background: #415fb2;
            color: #fff;
        }
        .success-batch {
            color: #23a86a;
        }
        .unsuccess-batch,
        .success-batch {
            display: flex;
            align-items: center;
        }
        .unsuccess-batch {
            color: #d52121;
        }
        /* Course Material  */
        .cmaterials-wraponly {
            display: flex;
            align-items: center;
            height: 88%;
        }
        .c-icon {
            width: 154px;
        }
        .material-block {
            margin-top: 1.7rem;
            padding: 0px 20px;
        }
        .material-block button {
            display: block;
            background: #4565bc !important;
            border-radius: 8px;
            text-align: center;
            padding: 15px;
            color: #99adea;
        }
        .material-block button:hover {
            background: #405dab;
            color: #fff;
        }
        .material-block li:first-child {
            margin-right: 30px;
        }
        .cmaterials-wrap {
            width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .c-icon i {
            font-size: 38px;
        }

        /* Coourse Materials  */
        /* .tbl-sm tbody td{
          padding:0.58rem 0.2rem;
        }
        .block-body .tbl-sm tr td:first-child{
          padding-top:0;
        } */
        .table-striped > tbody > tr:nth-of-type(2n + 1) {
            background-color: rgba(170, 170, 170, 0.05);
        }
        .ctmtable-striped > tbody > tr:nth-of-type(2n + 1) > * {
            background-color: rgb(246, 249, 255);
        }
        .ctmtable-striped tr td,
        .ctmtable-striped tr td a {
            color: #323744;
        }

        /* Attendance Calendar CSS */
        .calendar {
            color: #fff;
            margin: 25px auto;
            background: #4454b5;
            padding: 30px 20px 30px 20px;
            /* width: 95%;
            max-width: 600px;
            height: 325px; */
            border-radius: 5px;
            box-shadow: 0px 2px 6px rgba(2, 2, 2, 0.2);
            position: relative;
        }
        .calendar__title {
            text-align: center;
        }
        .calendar--day-view {
            position: absolute;
            border-radius: 3px;
            top: -2.5%;
            left: -2.5%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 1);
            box-shadow: 3px 12px 5px rgba(2, 2, 2, 0.16);
            z-index: 2;
            overflow: hidden;
            transform: scale(0.9) translate(30px, 30px);
            opacity: 0;
            visibility: hidden;
            /*   border-radius: 5px; */
            display: none;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .day-view-content {
            color: #222;
            width: 100%;
            padding-top: 55px;
        }
        .day-highlight,
        .day-add-event {
            padding: 8px 10px;
            margin: 12px 15px;
            border-radius: 4px;
            background: #e7e8e8;
            color: #222;
            font-size: 14px;
            font-weight: 600;
            font-family: "Avenir", sans-serif;
        }
        /* .row{
          width: 100%;
          display: flex;
          flex-wrap: wrap;
          align-items: center;
        } */
        .row .qtr {
            width: 40%;
        }
        .row .half {
            width: 100%;
        }
        @media (min-width: 800px) {
            /* .row{
              flex-wrap: nowrap;
            } */
            .row .half {
                width: 35%;
            }
            .row .qtr {
                width: 25%;
            }
        }

        .day-add-event {
            background: #04b6e2;
            color: #fff;
            padding: 16px;
            display: none;
            transform: translateY(-15px);
            opacity: 0;
        }
        .day-add-event[data-active="true"] {
            display: block;
            animation: popIn 250ms 1 forwards;
        }
        .add-event-label {
            padding: 10px 0;
            font-size: 18px;
            font-family: "Avenir", sans-serif;
            color: #fff;
            font-weight: 400;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
        }
        .add-event-edit {
            display: block;
            margin: 4px 0;
            max-width: 70%;
            border-bottom: 2px solid #fff;
            font-size: 18px;
            font-weight: 800;
            color: #fff;
        }
        .add-event-edit--long {
            max-width: 90%;
        }

        input.add-event-edit {
            border: none;
            border-bottom: 2px solid #fff;
            background: transparent;
            outline: none;
            font: inherit;
            color: #fff;
            font-size: 18px;
            font-weight: 800;
        }
        .add-event-edit--error,
        input.add-event-edit--error {
            border-color: #ff5151;
            animation: shake 300ms 1 forwards;
        }
        @keyframes shake {
            20%,
            60% {
                transform: translateX(4px);
            }
            40%,
            80% {
                transform: translateX(-4px);
            }
        }
        input.add-event-edit::-webkit-input-placeholder {
            color: #fff;
        }

        input.add-event-edit:-moz-placeholder {
            /* Firefox 18- */
            color: #fff;
        }

        input.add-event-edit::-moz-placeholder {
            /* Firefox 19+ */
            color: #fff;
        }

        input.add-event-edit:-ms-input-placeholder {
            color: #fff;
        }
        .event-btn {
            padding: 3px 8px;
            border: 3px solid #fff;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            width: 65px;
            margin: 5px 0;
            text-align: center;
        }

        .event-btn--save {
            border-color: #fff;
            background: #74c500;
            color: #fff;
            border-color: transparent;
        }
        .event-btn--save:hover {
            box-shadow: 0px 2px 4px rgba(2, 2, 2, 0.2);
        }
        .event-btn--cancel {
            background: #ff5151;
            color: #fff;
            border-color: transparent;
        }
        .event-btn--cancel:hover {
            box-shadow: 0px 2px 4px rgba(2, 2, 2, 0.2);
        }
        /* .add-event-btn:hover, .add.event-btn:focus{
          background: #00258e;
          box-shadow: 0px -1px 2px rgba(3,2,2,0.2);
        } */
        .day-highlight .day-events-link {
            border-bottom: 2px solid #222;
            padding: 0;
            cursor: pointer;
        }
        #add-event {
            color: #04b6e2;
            border-color: #04b6e2;
        }
        .day-view-exit {
            position: absolute;
            top: 24px;
            line-height: 1em;
            left: 22px;
            font-size: 22px;
            color: #252525;
            font-family: "Avenir", sans-serif;
            font-weight: 800;
            cursor: pointer;
            opacity: 0;
            animation: popIn 200ms 1 forwards;
            text-transform: uppercase;
        }
        .day-view-date {
            position: absolute;
            top: 19px;
            right: 22px;
            text-align: right;
            font-size: 22px;
            font-family: "Avenir", sans-serif;
            font-weight: 800;
            color: #393939;
            border-bottom: 2px solid #222;
            cursor: pointer;
        }
        .day-inspiration-quote {
            position: absolute;
            /*   top: 90px; */
            margin-top: -40px;
            left: 10%;
            width: 80%;
            height: calc(100% - 110px);
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            font-size: 18px;
            /* font-weight: 800; */
            letter-spacing: -1px;
            color: #212529;
            line-height: 1.4em;
            /* font-family: 'Avenir', sans-serif; */
            z-index: -1;
        }
        .day-event-list-ul {
            list-style: none;
            margin: auto;
            width: 95%;
            padding: 0;
            max-height: 300px;
            overflow: auto;
        }
        .day-event-list-ul li {
            padding: 10px;
            margin: 10px 0;
            /*   background: #04b6e2; */
            /*   box-shadow: 0px 1px 1px  rgba(2,2,2,0.5); */
            position: relative;
        }
        .event-dates small {
            font-size: 0.65em;
            color: #444;
        }
        .event-dates {
            font-weight: 800;
            font-family: "Avenir", sans-serif;
            color: #04b6e2;
            font-size: 18px;
            text-transform: lowercase;
            /*   position: relative; */
        }
        .event-delete {
            position: absolute;
            right: 10px;
            top: 0px;
            font-size: 12px;
            color: #f25656;
            cursor: pointer;
        }
        .event-name {
            font-size: 19px;
            font-family: "Avenir", sans-serif;
            color: #222;
            padding: 10px;
            background: #f7f7f7;
            margin: 2px 0;
            display: block;
            text-transform: initial;
        }
        .calendar--day-view-active {
            animation: popIn 200ms 1 forwards;
            visibility: visible;
            display: flex;
            transition: visibility 0ms;
        }
        .calendar--view {
            display: flex;
            flex-wrap: wrap;
            align-content: center;
            justify-content: flex-start;
            width: 100%;
        }
        .cview__month {
            width: 100%;
            text-align: center;
            font-weight: 800;
            font-size: 22px;
            font-family: "Avenir", sans-serif;
            padding-bottom: 20px;
            color: #d1d8ff;
            text-transform: uppercase;
            display: flex;
            flex-wrap: nowrap;
            align-items: baseline;
            justify-content: space-around;
        }
        .cview__month-last,
        .cview__month-next,
        .cview__month-current {
            width: 33.33333%;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            color: #d1d8ff;
        }
        .cview__header {
            color: #d1d8ff;
        }
        .cview__month-last:hover,
        .cview__month-next:hover {
            color: #fff;
        }

        .cview__month-current {
            font-size: 22px;
            cursor: default;
            animation: popIn 200ms 1 forwards;
            transform: translateY(20px);
            opacity: 0;
            position: relative;
        }
        .cview__month-reset {
            animation: none;
        }
        .cview__month-activate {
            animation: popIn 100ms 1 forwards;
        }
        .cview--spacer,
        .cview__header,
        .cview--date {
            width: 14.28571428571429%;
            max-width: 14.28571428571429%;
            padding: 10px;
            box-sizing: border-box;
            position: relative;
            text-align: center;
            overflow: hidden;
            text-overflow: clip;
            font-size: 14px;
            font-weight: 900;
        }
        .cview--date {
            font-size: 16px;
            font-weight: 400;
            cursor: pointer;
            background: #16a756;
            border: 1px solid #249f5b;
            width: 50px;
            height: 50px;
        }
        .has-events::after {
            border-radius: 100%;
            animation: popIn 200ms 1 forwards;
            background: rgba(255, 255, 255, 0.95);
            transform: scale(0);
            content: "";
            display: block;
            position: absolute;
            width: 8px;
            height: 8px;
            top: 8px;
            left: 12px;
        }
        .cview--date:hover::before {
            background: rgba(255, 255, 255, 0.2);
        }
        .cview--date.today {
            color: #111;
        }
        .cview--date.today::before {
            animation: popIn 200ms 1 forwards;
            background: rgba(255, 255, 255, 0.2);
            transform: scale(0);
        }
        @keyframes popIn {
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        .cview--date::before {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            content: "";
            transform: scale(0.8);
            z-index: 0;
        }
        .calendarfooter {
            width: 100%;
            bottom: 50px;
            left: 0;
            position: absolute;
            font-size: 14px;
            text-align: center;
        }
        .calendarfooter__link {
            cursor: pointer;
            padding: 2px 5px;
            border-bottom: 1px solid #fff;
        }
        /* End of Attendance Calendar CSS */
        /* Start of Quiz Report Page */
        .ctm-dflex {
            display: flex;
            align-items: center;
        }
        .chocolate-wrap {
            background: #eff6ff;
            padding: 15px 15px;
            border-radius: 6px;
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.03);
            -webkit-box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.03);
            -moz-box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.03);
        }
        .chocolate-block {
            display: inline-block;
            width: 70%;
        }
        .chocolate-block h6 {
            color: #e12698;
        }
        .chocolate-block p {
            margin-bottom: 10px;
        }
        .chocolate-block h3 {
            margin: 0;
        }
        .obtainedmark {
            font-weight: bold;
        }
        .chocolate-block-icon {
            width: 30%;
            text-align: right;
        }
        .chocolate-block-icon i {
            font-size: 66px;
        }
        /* End of Quiz Report Page */
        /* Start of Overall Report Page */
        .p-15 {
            padding: 15px;
        }
        .char-body h2 {
            margin-bottom: 0;
        }
        .sub-block-wrap,
        .qexam-history {
            display: flex;
            border-top: 1px solid #edf3fb;
        }
        .s-green,
        .cgreen,
        .paid i {
            /* color:#16a756; */
            color: rgb(35, 182, 121);
        }
        .s-leave {
            color: #c99d37;
        }
        .s-absent,
        .unpaid i {
            color: rgb(201, 25, 25);
        }
        .sub-block-wrap div {
            flex-grow: 1;
            margin-top: 15px;
            margin-right: 20px;
            border-right: 1px solid #edf3fb;
        }
        .sub-block-wrap div h3 {
            font-weight: 600;
            font-size: 1.4em;
        }
        .sub-block-wrap div h5 {
            font-size: 0.99em;
        }
        .sub-block-wrap div p {
            margin-bottom: 0;
        }
        .sub-block-wrap div:last-child {
            border-right: 0;
            margin-right: 0;
        }
        .total-block {
            margin-top: 3rem;
        }
        .total-block p:first-child,
        .total-block h3 {
            font-weight: bold;
        }
        .cpink {
            color: #e02597;
        }
        .cdisable {
            color: #c5c5c5;
        }
        .qexam-history table th,
        .qexam-history table td {
            border-bottom: 0;
        }
        .paid i,
        .unpaid i {
            font-size: 12px;
        }
        .unpaid span {
            background: rgb(201, 25, 25);
        }
        .paid span {
            background: #23b679;
        }
        .paid span,
        .unpaid span {
            padding: 5px;
            border-radius: 4px;
            display: inline-flex;
            align-content: center;
        }
        .paid span i,
        .paid span,
        .unpaid span i,
        .unpaid span {
            color: #fff;
        }
        .chocolate-block h3 {
            font-size: 1.2rem;
        }

        .btn-reveal-answer {
            background: #2c72ce !important;
            border: 1px solid #1c5db3;
            border-radius: 6px;
            color: #fff;
            margin-left: 5px;
        }
        .reveal-answer{
            display: flex;
            justify-content: space-between;
        }
        .btn-reveal{
            background: #5070c9;
            border: 1px solid #415fb2;
        }
        .btn-reveal:hover{
            background: #2866b7;
            border-color: #2365bb;
            color: #d6e7ff;
        }
        .btn-reveal:active{
            background: #5070c9!important;
            border: 1px solid #415fb2!important;
        }
        .btn-reveal:focus{
            background: #5070c9!important;
            border: 1px solid #415fb2!important;
            box-shadow: none!important;
        }


    </style>


</head>
<body>
<h1>Welcome to ItSolutionStuff.com</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card-wrap mt-4">
            <div class="ghead">
                <h3>1) Personal Details</h3>


                <div class="clearfix"></div>
            </div>
            <div class="block-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4 ">
                        <div class="mb-3">
                            <label for="first_name" class="form-label required">First Name</label>
                            <input type="text" class="form-control" oninvalid="this.setCustomValidity('Please enter first name here')" oninput="this.setCustomValidity('')" id="first_name" placeholder="Enter first name" name="first_name"   value="">


                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" placeholder="Enter middle name" name="middle_name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label required">Last Name</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name"  value="">

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 mb-3 gender-wrap required">
                                <label class="form-label block-label">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value = 'male' id="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value = 'female' id="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value = 'others' id="others">
                                    <label class="form-check-label" for="others">Others</label>

                                </div>


                            </div>


                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <label for="dob" class="form-label required">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name = "dob"  value = "">


                        </div>
                        <div class="mb-3">
                            <label for="select_country" class="form-label required">Country of Birth</label>
                            <select id="select_country" class="form-select" name="cob" >
                                <option value = ""></option>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="residental_address" class="form-label required">Residential Address</label>
                            <input type="text" class="form-control" placeholder = "Enter residental address" id="residental_address" name = "residental_address" value = "" >
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label required">Image</label>


                            <input  type="file" class="form-control" name="image" value="">

                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 mb-3 ">
                        <div class="mb-3">
                            <label for="email" class="form-label required">Email Address</label>
                            <input type="email" class="form-control" id="email" name = "email" placeholder = "Enter yout email address" value = "">

                        </div>
                        <div class="mb-3">
                            <label for="mobile_no" class="form-label required">Mobile No</label>
                            <input type="number" class="form-control"  id="mobile_no" name = "mobile_no"  placeholder = "Enter mobile number" value = "">

                        </div>

                        <div class="mb-3">
                            <label for="com_date" class="form-label required">Commencement Date</label>
                            <input type="date" class="form-control" id="com_date" name = "commencement_date" value = "">
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 mb-3">
                                    <label for="state" class="form-label required">State</label>
                                    <input type="text" class="form-control" id="state" placeholder = "Enter state" name = "state" value = "" >

                                </div>

                                <div class="col-sm-12 col-md-6 mb-3 ">
                                    <label for="postcode" class="form-label">Postcode</label>
                                    <input type="text" class="form-control" id="postcode" placeholder = "Enter postcode" name = "postcode" value = "">

                                </div>



                            </div>


                        </div>



                    </div>




                </div>
            </div>
        </div>
    </div>
</div>


<br/>
<strong>Public Folder:</strong>
<br/>
<strong>Storage Folder:</strong>
</body>
</html>
