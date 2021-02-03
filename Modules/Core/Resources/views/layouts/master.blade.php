<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/favicon.ico" />

        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
        <link href="{{ mix('admin/public/css/app.css') }}?v={{config('core.app_version')}}" rel="stylesheet">
        @yield('styles')
    </head>
    <body>
        
        <div id="page-content">
            <base-layout inline-template>
                <v-app id="content" v-cloak>
                    <v-main>
                        <v-app-bar
                            app
                            class="style-header"
                            elevation="0"
                        >
                            <v-app-bar-nav-icon
                                @click.stop="drawer = !drawer" color="white"></v-app-bar-nav-icon>

                            <v-spacer></v-spacer>

                            <v-btn icon color="white">
                                <v-icon>mdi-bell-ring</v-icon>
                            </v-btn>

                            @include('core::components.user_menu')
                        </v-app-bar>

                        <v-navigation-drawer 
                            elevation="3"
                            app
                            v-model="drawer"
                            class="style-navigation"
                            >
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title class="title">
                                        <a href="{{ url('/') }}" class="text-decoration-none">
                                            <img
                                                src="{{url('storage/app/public/img/logoproex.png')}}"
                                                alt="Logo FKUI"
                                                class="img-fluid"
                                                width="220px"
                                            >
                                        </a>
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-divider></v-divider>
                            @include('core::components.main_menu')
                        </v-navigation-drawer>

                        @if (isset($page_title) && isset($breadcrumbs))
                            @include('core::components.breadcrumbs', [
                                'breadcrumb_title' => $page_title,
                                'breadcrumbs' => $breadcrumbs
                            ])
                        @endif

                        <v-container fluid>
                            @yield('content')
                        </v-container>

                        <v-footer
                            app
                            color="white"
                            inset
                            class="font-weight-medium"
                        >
                            <v-col
                                cols="12"
                                class="d-flex align-content-center flex-wrap"
                            >
                                <v-icon
                                    small
                                    color="black"
                                    class="mr-1"
                                >
                                    mdi-copyright
                                </v-icon> @{{ new Date().getFullYear() }} — {{ config('app.name', 'Laravel') }}
                            </v-col>
                        </v-footer>
                    </v-main>

                </v-app>
            </base-layout>
        </div>
        
        <script src="{{ mix('admin/public/js/app.js') }}?v={{config('core.app_version')}}"></script>
        @yield('scripts')
    </body>
</html>