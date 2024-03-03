@extends('layouts.app')

@section('content')
    <div class="jumbotron glass text-center p-5 rounded-0">
        <div class="container py-5">
            <div class="logo-deliveboo mb-5">
                <svg width="100%" height="100%" viewBox="0 0 1182 1182" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                    style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <g>
                        <path
                            d="M683.556,356.181c-3.695,-3.174 -4.759,-10.457 -12.217,-7.837c-0.327,0.115 -1.412,-0.698 -1.371,-0.96c1.522,-9.923 -10.046,-8.426 -11.776,-12.722c-2.421,-6.011 -5.58,-10.146 -10.145,-14.086c-2.721,-2.348 -3.551,-7.952 -9.088,-4.574c-2.308,-4.029 -4.863,-11.569 -6.878,-11.426c-6.035,0.425 -8.608,-1.721 -9.056,-6.775c-0.4,-4.516 -1.207,-6.961 -6.477,-5.587c-0.997,0.26 -3.372,-1.611 -3.825,-2.938c-3.219,-9.41 -8.271,-16.634 -18.926,-18.405c-1.173,-0.194 -2.48,-1.87 -3.031,-3.156c-5.769,-13.475 -15.887,-21.873 -28.334,-29.559c-5.637,-3.483 -15.792,-8.023 -15.041,-18.746c0.031,-0.441 -0.653,-1.309 -1.058,-1.345c-10.83,-0.937 -11.503,-11.937 -17.252,-17.854c-4.085,-4.206 -9.638,-6.299 -13.121,-11.398c-3.832,-5.61 -8.863,-10.55 -13.998,-15.068c-3.821,-3.361 -9.034,-5.132 -12.88,-8.472c-2.785,-2.421 -4.321,-6.269 -6.461,-9.449c-1.205,-1.79 -2.472,-3.544 -3.777,-5.263c-1.821,-2.4 -3.704,-4.753 -5.317,-7.865c0.077,-0.679 -0.091,-0.621 -0.256,-0.563c-0.58,-1.962 -1.162,-3.925 -1.529,-6.637c0.052,-0.688 -0.107,-0.626 -0.268,-0.563c-1.849,-14.904 -0.739,-29.008 10.674,-40.419c27.308,-27.301 54.43,-54.79 82.003,-81.82c6.603,-6.474 15.273,-9.544 24.93,-9.422c3.886,0.049 7.79,-1.312 11.817,-2.736c0.932,-0.703 1.732,-0.703 3.127,-0.068c2.248,2.451 3.715,5.587 5.588,5.852c8.266,1.171 14.002,5.763 19.522,11.563c10.036,10.542 20.463,20.716 30.891,30.875c11.449,11.153 23.329,21.871 34.578,33.217c19.317,19.48 38.187,39.402 57.462,58.926c7.126,7.221 15.135,13.57 22.26,20.793c12.741,12.919 24.89,26.425 37.709,39.264c11.969,11.988 24.733,23.185 36.697,35.18c12.811,12.844 24.936,26.369 37.65,39.31c16.643,16.937 33.588,33.572 50.371,50.372c18.91,18.932 37.658,38.028 56.707,56.821c21.713,21.423 43.9,42.369 65.472,63.933c20.702,20.697 40.852,41.946 61.294,62.904c17.647,18.091 35.365,36.112 53.251,54.762c1.321,1.392 2.441,2.185 3.478,2.972c-0.085,-0.008 -0.067,-0.175 -0.593,0.428c8.913,21.561 5.255,40.037 -10.962,56.182c-10.99,10.943 -22.02,21.847 -32.845,32.951c-4.659,4.782 -8.847,10.026 -13.25,14.99c-0.003,-0.07 0.137,-0.067 -0.49,-0.177c-28.656,27.809 -56.74,55.677 -84.707,83.663c-135.212,135.293 -270.502,270.508 -405.446,406.069c-17.082,17.159 -35.199,25.328 -58.775,15.653c-0.306,-0.125 -0.941,0.55 -1.422,0.851c0,-0 0.171,-0.013 0.496,-0.415c-0.91,-1.259 -2.146,-2.117 -3.383,-2.976c-6.642,-6.066 -13.502,-11.913 -19.872,-18.255c-8.351,-8.314 -16.12,-17.219 -24.538,-25.46c-3.575,-3.501 -8.197,-5.92 -12.279,-8.915c-1.641,-1.205 -3.865,-2.335 -4.542,-4.016c-5.686,-14.109 -17.281,-22.589 -28.867,-31.147c-0.851,-0.629 -1.521,-1.704 -1.92,-2.712c-1.951,-4.931 -3.784,-9.91 -5.304,-15.634c0.346,-1.39 0.339,-2.019 0.333,-2.65c-0.241,0.766 -0.479,1.531 -0.72,2.297c-0.537,-4.553 -2.321,-9.38 -1.394,-13.609c3.753,-17.111 15.272,-29.134 27.649,-40.681c12.364,-11.535 23.95,-23.901 36.041,-35.735c11.015,-10.785 22.429,-21.166 33.328,-32.063c8.808,-8.808 16.863,-18.369 25.681,-27.166c34.238,-34.158 68.763,-68.027 102.956,-102.227c28.192,-28.197 55.986,-56.79 84.103,-85.063c36.682,-36.884 73.576,-73.559 110.219,-110.482c7.853,-7.912 11.802,-17.595 9.924,-29.057c-0.097,-0.589 -0.1,-1.193 -0.159,-1.789c-1.753,-17.814 -11.36,-33.947 -24.507,-44.825c-5.224,-4.322 -9.277,-10.044 -13.965,-15.033c-4.768,-5.073 -9.564,-10.127 -14.52,-15.013c-9.36,-9.226 -18.743,-18.434 -28.378,-27.367c-1.545,-1.432 -5.364,-0.691 -6.526,-2.197c-2.586,-3.349 -4.155,-7.486 -6.839,-11.699c-0.698,-0.397 -0.958,-0.676 -0.958,-0.676c-3.415,-1.961 -7.403,-3.347 -10.095,-6.034c-3.15,-3.145 -5.032,-7.527 -7.77,-11.14c-0.714,-0.946 -3.029,-0.647 -3.804,-1.585c-2.538,-3.077 -4.666,-6.49 -7.031,-9.714c-1.213,-1.654 -2.599,-3.182 -4.568,-5.119c-0.663,-0.351 -0.924,-0.634 -0.924,-0.634c-7.436,-3.803 -13.006,-9.407 -17.091,-17.397c-0.642,-0.331 -0.902,-0.609 -0.902,-0.609c-3.853,-2.861 -4.417,-10.851 -12.12,-7.791c-0.312,0.124 -1.425,-0.681 -1.384,-0.918c1.891,-10.961 -15.064,-7.552 -13.706,-18.036c-9.432,-2.94 -11.339,-13.127 -17.838,-18.419c-3.308,-2.693 -7.912,-3.306 -7.073,-9.88c-0.881,0.899 -1.761,1.797 -2.642,2.696c-1.998,-1.916 -4.245,-3.641 -5.911,-5.811c-1.241,-1.613 -1.734,-3.805 -3.204,-6.072c-0.645,-0.333 -0.905,-0.613 -0.905,-0.613Z"
                            style="fill:#9df2e9;fill-rule:nonzero;" />
                        <path
                            d="M477.038,803.115c8.33,8.112 16.711,16.172 24.976,24.351c9.778,9.676 19.453,19.455 29.808,30.236c12.404,21.814 10.661,43.175 -4.869,58.978c-25.862,26.317 -51.886,52.481 -78.206,78.338c-14.144,13.896 -31.027,17.044 -49.738,10.174c-2.75,-1.01 -5.747,-1.343 -8.631,-1.991c0,0 0.119,-0.092 0.544,-0.557c-1.09,-1.291 -2.605,-2.117 -4.121,-2.945c-19.754,-19.795 -39.46,-39.639 -59.274,-59.372c-15.21,-15.148 -30.623,-30.089 -45.825,-45.245c-26.438,-26.358 -52.804,-52.79 -79.135,-79.257c-2.053,-2.066 -3.598,-4.64 -6.236,-7.842c-1.872,-0.946 -2.884,-1.026 -3.896,-1.106c0,0 0.114,-0.087 0.455,-0.759c-0.538,-0.814 -1.418,-0.958 -2.298,-1.101c-0,0 0.128,-0.024 0.484,-0.704c-0.523,-0.818 -1.402,-0.954 -2.283,-1.092c0,-0 0.129,-0.03 0.504,-0.711c-0.518,-0.816 -1.41,-0.953 -2.304,-1.091c0,-0 0.129,-0.029 0.504,-0.702c-0.518,-0.817 -1.41,-0.96 -2.304,-1.103c0,0 0.129,-0.047 0.653,-0.538c-1.657,-1.933 -3.838,-3.379 -6.02,-4.823c0,0 0.124,-0.083 0.643,-0.658c-1.069,-1.366 -2.657,-2.155 -4.244,-2.943c-0,-0 0.121,-0.098 0.612,-0.459c-0.424,-1.21 -1.34,-2.062 -2.255,-2.912c-2.289,-2.106 -4.576,-4.213 -7.253,-7.569c-1.49,-1.386 -2.591,-1.522 -3.692,-1.66c-0,-0 0.115,-0.082 0.461,-0.753c-0.536,-0.815 -1.417,-0.956 -2.297,-1.099c-0,-0 0.127,-0.026 0.484,-0.7c-0.523,-0.816 -1.404,-0.959 -2.284,-1.102c-0,0 0.128,-0.026 0.485,-0.699c-0.523,-0.816 -1.404,-0.96 -2.285,-1.101c0,0 0.129,-0.044 0.654,-0.619c-1.057,-1.365 -2.64,-2.153 -4.222,-2.94c-0,-0 0.119,-0.073 0.483,-0.747c-0.528,-0.814 -1.42,-0.956 -2.313,-1.099c-0,0 0.128,-0.026 0.485,-0.699c-0.523,-0.816 -1.404,-0.959 -2.285,-1.101c0,0 0.128,-0.027 0.486,-0.701c-0.524,-0.816 -1.404,-0.957 -2.285,-1.1c-0,-0 0.128,-0.026 0.485,-0.701c-0.523,-0.815 -1.404,-0.958 -2.285,-1.101c0,-0 0.128,-0.026 0.485,-0.706c-0.523,-0.816 -1.403,-0.954 -2.283,-1.091c-0,0 0.13,-0.052 0.698,-0.598c-1.046,-1.355 -2.66,-2.164 -4.274,-2.974c-0,-0 0.121,-0.062 0.469,-0.735c-0.532,-0.816 -1.412,-0.958 -2.293,-1.101c0,0 0.128,-0.026 0.485,-0.699c-0.523,-0.816 -1.404,-0.959 -2.284,-1.102c0,-0 0.128,-0.027 0.485,-0.7c-0.523,-0.816 -1.404,-0.959 -2.285,-1.1c0,-0 0.13,-0.043 0.658,-0.612c-1.058,-1.364 -2.645,-2.159 -4.232,-2.954c0,-0 0.119,-0.09 0.637,-0.578c-1.665,-1.931 -3.847,-3.377 -6.029,-4.821c0,0 0.119,-0.07 0.465,-0.743c-0.534,-0.816 -1.415,-0.957 -2.295,-1.101c-0,0 0.129,-0.04 0.657,-0.609c-1.059,-1.365 -2.646,-2.16 -4.232,-2.955c-0,0 0.12,-0.066 0.472,-0.74c-0.53,-0.814 -1.413,-0.957 -2.296,-1.099c0,0 0.128,-0.026 0.487,-0.701c-0.523,-0.816 -1.405,-0.957 -2.286,-1.1c-0,-0 0.128,-0.044 0.653,-0.605c-1.059,-1.363 -2.643,-2.163 -4.228,-2.963c0,0 0.125,-0.076 0.643,-0.644c-1.069,-1.364 -2.656,-2.161 -4.242,-2.956c-0,0 0.12,-0.065 0.472,-0.738c-0.53,-0.816 -1.413,-0.958 -2.296,-1.099c0,-0 0.128,-0.028 0.487,-0.701c-0.522,-0.816 -1.404,-0.959 -2.286,-1.101c-0,0 0.127,-0.026 0.486,-0.701c-0.523,-0.816 -1.405,-0.957 -2.286,-1.1c0,-0 0.129,-0.049 0.655,-0.544c-1.657,-1.934 -3.84,-3.375 -6.023,-4.814c0,-0 0.118,-0.075 0.469,-0.748c-0.532,-0.815 -1.416,-0.956 -2.299,-1.099c0,-0 0.128,-0.026 0.487,-0.701c-0.523,-0.816 -1.405,-0.958 -2.286,-1.101c-0,0 0.127,-0.026 0.486,-0.699c-0.524,-0.816 -1.405,-0.959 -2.286,-1.103c0,0 0.128,-0.026 0.485,-0.699c-0.523,-0.816 -1.404,-0.959 -2.284,-1.1c-0,-0 0.128,-0.044 0.656,-0.613c-1.057,-1.363 -2.643,-2.157 -4.228,-2.952c-0,0 0.12,-0.065 0.471,-0.74c-0.532,-0.816 -1.415,-0.957 -2.298,-1.099c0,0 0.128,-0.027 0.487,-0.701c-0.523,-0.816 -1.404,-0.959 -2.286,-1.1c-0,-0 0.127,-0.026 0.485,-0.701c-0.522,-0.816 -1.404,-0.958 -2.285,-1.101c0,0 0.128,-0.026 0.485,-0.699c-0.523,-0.816 -1.404,-0.959 -2.284,-1.103c-0,0 0.131,-0.047 0.659,-0.494c-2.256,-2.52 -5.039,-4.592 -7.823,-6.665c-0,0 0.117,-0.073 0.463,-0.745c-0.536,-0.816 -1.416,-0.959 -2.297,-1.1c0,-0 0.128,-0.026 0.485,-0.701c-0.524,-0.816 -1.404,-0.958 -2.284,-1.101c-0,0 0.129,-0.041 0.657,-0.61c-1.059,-1.364 -2.646,-2.159 -4.232,-2.956c-0,0 0.119,-0.065 0.472,-0.738c-0.53,-0.815 -1.413,-0.958 -2.296,-1.099c0,-0 0.128,-0.044 0.655,-0.607c-1.059,-1.361 -2.644,-2.161 -4.229,-2.961c-0,0 0.12,-0.061 0.469,-0.735c-0.532,-0.816 -1.413,-0.959 -2.294,-1.102c0,-0 0.13,-0.041 0.66,-0.603c-1.059,-1.365 -2.648,-2.165 -4.236,-2.965c-0,0 0.12,-0.061 0.47,-0.734c-0.531,-0.815 -1.412,-0.958 -2.292,-1.101c0,-0 0.128,-0.026 0.485,-0.699c-0.523,-0.817 -1.404,-0.96 -2.284,-1.103c-0,0 0.128,-0.042 0.653,-0.605c-1.059,-1.362 -2.643,-2.161 -4.228,-2.961c0,0 0.125,-0.078 0.646,-0.639c-1.068,-1.364 -2.658,-2.164 -4.247,-2.964c-0,0 0.12,-0.062 0.47,-0.735c-0.531,-0.816 -1.411,-0.958 -2.292,-1.101c0,0 0.128,-0.026 0.485,-0.699c-0.524,-0.818 -1.404,-0.959 -2.284,-1.102c-0,-0 0.127,-0.026 0.484,-0.7c-0.523,-0.816 -1.404,-0.959 -2.284,-1.102c0,0 0.129,-0.047 0.654,-0.54c-1.657,-1.935 -3.841,-3.377 -6.024,-4.819c0,-0 0.118,-0.073 0.466,-0.745c-0.533,-0.815 -1.414,-0.958 -2.294,-1.101c0,0 0.128,-0.026 0.485,-0.699c-0.524,-0.816 -1.404,-0.959 -2.284,-1.101c-0,-0.001 0.127,-0.026 0.484,-0.701c-0.523,-0.816 -1.404,-0.957 -2.284,-1.1c0,-0 0.128,-0.026 0.485,-0.7c-0.524,-0.816 -1.404,-0.959 -2.285,-1.102c0,-0 0.13,-0.049 0.664,-0.533c-1.655,-1.932 -3.843,-3.381 -6.031,-4.828c-0,0 0.119,-0.07 0.465,-0.743c-0.535,-0.815 -1.415,-0.958 -2.295,-1.101c-0,0 0.127,-0.026 0.485,-0.699c-0.524,-0.816 -1.404,-0.959 -2.285,-1.101c-0,0 0.128,-0.027 0.486,-0.701c-0.524,-0.816 -1.405,-0.959 -2.285,-1.1c-0,-0 0.132,-0.054 0.637,-0.426c-0.425,-1.23 -1.355,-2.083 -2.286,-2.939c-8.609,-5.154 -10.487,-14.743 -15.549,-22.281c-0.643,-7.471 -0.643,-15.32 -0.643,-24.005c1.205,-1.476 3.193,-1.861 3.498,-2.795c5.892,-18.047 21.137,-28.455 33.475,-41.18c12.862,-13.266 26.041,-26.226 39.103,-39.297c13.059,-13.068 26.152,-26.104 39.217,-39.167c14.663,-14.662 29.306,-29.345 43.97,-44.008c16.031,-16.028 32.06,-32.057 48.116,-48.059c14.281,-14.232 28.651,-28.375 42.886,-42.651c15.79,-15.834 31.452,-31.797 47.211,-47.66c12.82,-12.904 25.594,-25.859 38.586,-38.589c18.105,-17.738 36.374,-35.308 54.61,-52.911c18.164,-17.532 42.214,-14.078 58.932,-2.368c9.867,6.912 17.786,16.629 26.49,25.179c7.45,7.318 14.853,14.689 22.122,22.187c6.297,6.494 12.34,13.232 18.561,19.798c4.814,5.08 9.733,10.06 15.327,16.019c16.083,23.576 14.566,45.036 -4.356,64.293c-26.657,27.126 -53.543,54.025 -80.432,80.923c-48.274,48.289 -96.596,96.529 -144.963,144.724c-8.789,8.756 -14.671,18.741 -15.747,31.379c-0.997,11.712 2.353,23 8.654,27.504c0,-0 -0.128,0.061 -0.616,0.429c0.34,1.375 1.167,2.382 1.994,3.388c0.667,0.792 1.335,1.583 1.696,3.192c2.98,4.22 6.265,7.623 9.55,11.026c1.038,0.838 2.076,1.675 3.34,3.618c2.014,2.527 3.803,3.95 5.591,5.371c0,-0 -0.096,0.058 0.111,0.439c0.724,0.714 1.244,1.047 1.764,1.38c1.62,1.421 3.238,2.843 5.099,5.407c2.661,3.159 5.078,5.177 7.496,7.193c1.034,0.839 2.069,1.678 3.455,3.433c0.858,1.271 1.364,1.624 1.871,1.979c0,-0 -0.102,0.037 0.096,0.414c0.7,0.712 1.202,1.049 1.706,1.386c-0,-0 -0.107,0.034 -0.039,0.619c1.886,1.977 3.704,3.369 5.521,4.761c0.606,0.065 1.074,0.354 1.701,1.714c0.806,1.201 1.314,1.556 1.823,1.91c-0,0 -0.109,0.038 0.089,0.412c0.7,0.712 1.206,1.05 1.709,1.388c0,0 -0.109,0.039 0.091,0.415c0.708,0.711 1.215,1.046 1.724,1.382c-0,0 -0.121,0.038 -0.054,0.613c1.862,1.972 3.657,3.371 5.453,4.769c0,0 -0.115,0.057 0.077,0.428c0.697,0.715 1.2,1.058 1.704,1.401c-0,0 -0.106,0.038 0.091,0.413c0.702,0.713 1.205,1.051 1.709,1.387c-0,0 -0.107,0.039 0.101,0.42c0.726,0.715 1.246,1.05 1.764,1.387c0.609,0.052 1.08,0.335 1.584,1.886c1.962,2.457 3.752,3.878 5.541,5.299c-0,0 -0.096,0.057 0.099,0.431c0.698,0.711 1.202,1.049 1.704,1.387c-0,0 -0.104,0.038 0.104,0.42c0.728,0.715 1.247,1.048 1.767,1.382c1.037,0.837 2.073,1.673 3.332,3.621c2.635,3.135 5.047,5.158 7.461,7.18c0.608,0.057 1.079,0.342 1.605,1.859c1.379,1.842 2.567,2.678 3.753,3.512c-0,0 -0.122,0.057 0.073,0.431c0.698,0.715 1.204,1.06 1.709,1.405c-0,-0 -0.114,0.034 -0.047,0.614c1.871,1.968 3.676,3.355 5.482,4.743c0,0 -0.126,0.082 -0.048,0.615c1.262,1.355 2.446,2.177 3.629,2.998c-0,0 -0.122,0.059 0.073,0.431c0.7,0.716 1.205,1.06 1.71,1.405c0,0 -0.112,0.038 0.087,0.412c0.703,0.712 1.208,1.05 1.713,1.388c0,0 -0.115,0.036 -0.052,0.616c2.465,2.571 4.864,4.563 7.263,6.555c0,-0 -0.12,0.058 0.075,0.431c0.7,0.717 1.207,1.06 1.712,1.405c0,-0 -0.112,0.037 0.086,0.411c0.704,0.712 1.209,1.05 1.714,1.39c0,0 -0.112,0.038 0.086,0.412c0.709,0.71 1.219,1.047 1.727,1.383c0,0 -0.122,0.039 -0.096,0.431c0.228,0.911 0.429,1.431 0.631,1.951c0.378,-0.679 0.757,-1.359 1.135,-2.039c1.201,1.29 2.403,2.579 3.369,4.716c0.572,1.283 1.381,1.717 2.189,2.151c1.038,0.842 2.076,1.685 3.338,3.637c3.236,3.732 6.248,6.352 9.259,8.973c0.613,0.058 1.086,0.346 1.592,1.902c1.974,2.449 3.772,3.859 5.572,5.268c0,0 -0.126,0.059 -0.06,0.633c1.867,1.974 3.665,3.374 5.463,4.774c0,-0 -0.117,0.073 -0.053,0.645c1.874,1.974 3.686,3.374 5.497,4.776c0.608,0.072 1.075,0.366 1.574,1.922c3.78,4.26 7.395,7.48 11.009,10.697c0.613,0.061 1.085,0.348 1.587,1.911c3.183,3.662 6.198,6.278 9.213,8.896Z"
                            style="fill:#81d5cd;fill-rule:nonzero;" />
                    </g>
                </svg>
            </div>
            <h1 class="display-5 fw-bold my-5">
                BENVENUTO SU <span id="DeliveBoo-logo" class="logo m-0 welcome-page">DeliveBoo</span><span id="admin-logo"
                    class="welcome-page">admin</span>
            </h1>
            <p class="fs-4 my-5">Qui puoi gestire, modificare e creare i tuoi ristoranti con il relativo menù. Hai a
                disposizione una dashboard per controllare l'andamento del tuo ristorante e dei singoli piatti.</p>

            @guest
                <a href="{{ route('login') }}" class="btn btn-secondary btn-lg me-3" type="button">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg" type="button">{{ __('Register') }}</a>
                @endif
            @else
                @if ($user && $user->restaurant)
                    <a href="{{ route('admin.restaurants.show', ['restaurant' => $user->restaurant->id]) }}"
                        class="btn btn-primary btn-lg" type="button">Il Mio
                        Ristorante</a>
                @else
                    <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary btn-lg" type="button">Crea il Tuo
                        Ristorante</a>
                @endif
            @endguest
        </div>
    </div>
    <svg class="wave" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
        preserveAspectRatio="none">
        <path class="wave-last"
            d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
            opacity=".25" class="shape-fill" fill="#FFFFFF" fill-opacity="0"></path>
        <path class="wave-middle"
            d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
            opacity=".5" class="shape-fill" fill="#FFFFFF" fill-opacity="0"></path>
        <path class="wave-first"
            d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
            class="shape-fill"></path>
    </svg>

    <section class="my-5 text-bool">

        {{-- charts --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <div class="container my-5">
            <div class="row gap-4 py-5">
                <div
                    class="col-12 col-md-6 glass-clear chart-container p-3 d-flex justify-content-center align-items-center">
                    <canvas id="radar-chart"></canvas>
                </div>

                <div class="col">
                    <h1 class="my-5">
                        Grafici interattivi: prendi il controllo del tuo ristorante con DeliveBoo admin</h1>
                    <p>Con i grafici interattivi di DeliveBoo, hai una finestra cristallina sul tuo ristorante. Monitora
                        vendite, clienti, tempi di attesa e altro ancora, prendendo decisioni informate per ottimizzare il
                        tuo business.<br>
                        DeliveBoo ti aiuta a:
                    <ul class="fa-ul">
                        <li><span class="fa-li"><i class="fa-solid fa-chart-line"></i></span>Controllare il tuo ristorante
                        </li>
                        <li><span class="fa-li"><i class="fa-solid fa-user"></i></span>Prendere decisioni informate</li>
                        <li><span class="fa-li"><i class="fa-solid fa-arrows-rotate"></i></span>Aggiornare periodicamente
                        </li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <svg data-name="Layer 1" class="wave upside-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
        preserveAspectRatio="none">
        <path
            d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
            class="wave-first"></path>
    </svg>

    <section class="py-5 glass rounded-0 border-0">

        <div class="container my-5">
            <h1 class="text-center my-5">Cosa fa DeliveBoo admin?</h1>
            <div class="row gap-3 justify-content-center">

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="glass bg-trasparent text-center p-3">
                        <div>
                            <i class="fa-solid fa-utensils fa-3x mb-3"></i>
                            <h5>Piatti</h5>
                            <p>Gestisci i piatti del tuo ristorante.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="glass bg-trasparent text-center p-3">
                        <div>
                            <i class="fa-solid fa-user fa-3x mb-3"></i>
                            <h5>Clienti</h5>
                            <p>Gestisci i clienti del tuo ristorante.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="glass bg-transparent text-center p-3">
                        <div>
                            <i class="fa-solid fa-clock fa-3x mb-3"></i>
                            <h5>Ordini</h5>
                            <p>Gestisci gli ordini del tuo ristorante.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <svg class="wave" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
        preserveAspectRatio="none">
        <path class="wave-last"
            d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
            opacity=".25" class="shape-fill" fill="#FFFFFF" fill-opacity="0"></path>
        <path class="wave-middle"
            d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
            opacity=".5" class="shape-fill" fill="#FFFFFF" fill-opacity="0"></path>
        <path class="wave-first"
            d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
            class="shape-fill"></path>
    </svg>

    <section class="my-5 text-bool">

        <div class="container my-5">
            <div class="row gap-4 py-5">
                <div class="col">
                    <h1 class="my-5">
                        Come DeliveBoo aumenta i tuoi profitti
                    </h1>
                    <p>
                        Come DeliveBoo aumenta i tuoi profitti
                        DeliveBoo è la piattaforma di food delivery più innovativa e conveniente sul mercato, progettata per
                        aumentare i profitti del tuo ristorante in modo significativo rispetto ai concorrenti. <br>
                        Ecco alcuni dei modi in cui DeliveBoo ti aiuta a massimizzare le tue entrate:
                    <ul class="fa-ul">
                        <li><span class="fa-li"><i class="fa-solid fa-users"></i></span><span class="fw-bold">Ampio
                                bacino
                                di utenti:</span> DeliveBoo vanta una base di clienti in
                            continua crescita, entusiasta di
                            ordinare cibo online. Il tuo ristorante sarà presente sulla nostra piattaforma, raggiungendo un
                            pubblico più ampio e aumentando le tue possibilità di ricevere ordini.</li>
                        <li><span class="fa-li"><i class="fa-solid fa-magnifying-glass"></i></span><span
                                class="fw-bold">Posizionamento strategico nei risultati di
                                ricerca:</span> DeliveBoo
                            utilizza algoritmi avanzati per
                            posizionare il tuo ristorante in cima ai risultati di ricerca, garantendoti una maggiore
                            visibilità e attirando più clienti.</li>
                        <li><span class="fa-li"><i class="fa-solid fa-bullhorn"></i></span><span
                                class="fw-bold">Marketing mirato:</span> Promuoviamo il tuo
                            ristorante attraverso campagne
                            marketing mirate sui social
                            media e canali di marketing online, aumentando la consapevolezza del tuo brand e attirando nuovi
                            clienti.</li>
                    </ul>
                    </p>
                </div>

                <div
                    class="col-12 col-md-6 glass-clear chart-container p-3 d-flex justify-content-center align-items-center">
                    <canvas id="bar-chart" class=""></canvas>
                </div>

            </div>
        </div>
    </section>



    <section class="mt-5 py-5 glass rounded-0">
        <div class="container py-5">
            <div class="row gap-4 py-5">
                <div class="col-12 col-md-6">
                    <img class="img-fluid rounded-4" src="{{ asset('img/front-end-sample.png') }}" alt="">
                </div>
                <div class="col">
                    <h1>DeliveBoo: l'app di food delivery che unisce bellezza e praticità</h1>
                    <p>
                        DeliveBoo non è solo un'app di food delivery, è un'esperienza di design raffinato e intuitività
                        d'uso. <br>
                        Un'interfaccia elegante e accattivante:
                    <ul class="fa-ul">
                        <li class="my-3"><span class="fa-li"><i class="fa-solid fa-star"></i></span>L'app DeliveBoo si
                            distingue
                            per la sua
                            interfaccia utente moderna e
                            minimalista, curata nei minimi dettagli per offrirti un'esperienza visiva piacevole e
                            coinvolgente.</li>
                        <li class="my-3"><span class="fa-li"><i class="fa-solid fa-image"></i></span>Le immagini dei
                            piatti sono
                            di alta qualità
                            e scattate professionalmente, per stuzzicare il tuo appetito e farti vivere l'emozione di
                            ordinare il tuo cibo preferito.</li>
                        <li class="my-3"><span class="fa-li"><i class="fa-solid fa-arrows"></i></span>La navigazione è
                            fluida e
                            intuitiva,
                            permettendoti di trovare il ristorante che cerchi in pochi secondi e ordinare il tuo pasto con
                            un semplice tocco.</li>
                    </ul>
                    </p>
                    <a href="{{ env('APP_FRONTEND_URL') }}" class="btn btn-primary">Prova DeliveBoo ora</a>
                </div>
            </div>
        </div>
    </section>



    <footer>
        <div class="container">
            <p class="text-center">Made with &hearts; by</p>
            <div class="row gap-4 flex-column">
                <div class="col">
                    <a class="github-profile" href="https://github.com/ChiaraRuggi">
                        <img class="rounded-circle avatar" src="https://github.com/ChiaraRuggi.png"
                            alt="Chiara Ruggi avatar">
                        <span class="ms-3">Chiara Ruggi</span>
                    </a>
                </div>
                <div class="col">
                    <a class="github-profile" href="https://github.com/SassaroCristian">
                        <img class="rounded-circle avatar" src="https://github.com/SassaroCristian.png"
                            alt="Sassaro Cristian avatar">
                        <span class="ms-3">Cristian Sassaro</span>
                    </a>
                </div>
                <div class="col">
                    <a class="github-profile" href="https://github.com/PinoGabriel">
                        <img class="rounded-circle avatar" src="https://github.com/PinoGabriel.png"
                            alt="Gabriel Pino avatar">
                        <span class="ms-3">Gabriel Pino</span>
                    </a>
                </div>
                <div class="col">
                    <a class="github-profile" href="https://github.com/Francesco-Rapetti">
                        <img class="rounded-circle avatar" src="https://github.com/Francesco-Rapetti.png"
                            alt="Francesco Rapetti avatar">
                        <span class="ms-3">Francesco Rapetti</span>
                    </a>
                </div>

            </div>

        </div>
    </footer>


    <script>
        // radar chart
        const radar = document.getElementById('radar-chart');
        new Chart(radar, {
            type: 'radar',
            data: {
                labels: ['Soddisfazione', 'Sicurezza', 'Prestazioni', 'Pianificazione',
                    'Problemi'
                ],
                datasets: [{
                    label: 'Cliente',
                    data: [100, 100, 100, 100, 0],
                    hoverBorderWidth: 5,
                    borderWidth: 1,
                    backgroundColor: 'rgba(76, 232, 249, 0.8)'

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // bar chart
        const bar = document.getElementById('bar-chart');
        new Chart(bar, {
            type: 'bar',
            data: {
                labels: ['DeliveBoo', 'Altre piattaforme'],
                datasets: [{
                    label: 'Profitto',
                    data: [100, 10],
                    hoverBorderWidth: 5,
                    borderWidth: 0,
                    backgroundColor: 'rgba(76, 232, 249, 0.8)'
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                backgroundColor: 'rgba(76, 232, 249, 1)'
            }
        });
    </script>
@endsection
