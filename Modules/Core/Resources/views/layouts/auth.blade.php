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
                        <v-container
                            class="fill-height justify-center"
                        >
                            <v-row
                                align="center"
                                justify="center"
                            >
                                <v-col
                                    xl="7"
                                    lg="11"
                                    sm="8"
                                >
                                    <v-card class="elevation-4" light>
                                        <v-row>
                                            <v-col
                                                lg="5"
                                            >
                                                <div class="pa-7 pa-sm-12">
                                                    @yield('content')
                                                </div>
                                            </v-col>
                                            <v-col
                                                lg="7"
                                                class="style-bg-green-1 d-none d-md-flex justify-center align-center"
                                            >
                                                <div class="d-none d-sm-block">
                                                    <div class="d-flex align-center pa-10">
                                                        <div>
                                                            <h2 class="display-1 white--text font-weight-medium">
                                                                DUNGNIME
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-main>

                </v-app>
            </base-layout>
        </div>
        
        <script src="{{ mix('admin/public/js/app.js') }}?v={{config('core.app_version')}}"></script>
        @yield('scripts')
    </body>
</html>