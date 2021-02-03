<main-menu-component
    inline-template
    :menu='@json(config('core.user_menu', []))'>
    <v-menu
        bottom
        min-width="200px"
        rounded
        offset-y
    >
        <template v-slot:activator="{ on }">
            <v-btn
                icon
                x-large
                v-on="on"
                class="mr-1"
            >
                
                <v-icon color="white">
                    mdi-account-circle
                </v-icon>
            </v-btn>
        </template>
        <v-list>
            <v-list-item>
                <v-list-item-avatar>
                    <v-avatar color="white">
                        <v-icon>
                            mdi-account-circle
                        </v-icon>
                    </v-avatar>
                </v-list-item-avatar>
            </v-list-item>

            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="title">
                        {{ Auth::user()->nama ?? '' }}
                    </v-list-item-title>
                    <v-list-item-subtitle>{{ Auth::user()->email ?? '' }}</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-list>
        <v-divider></v-divider>
        <v-list dense>
            <v-list-item-group
                color="primary"
            >
                <v-list-item
                    v-for="(item, i) in menu"
                    :key="i"
                    :href="ziggy(item.uri).url()"
                >
                    <v-list-item-icon>
                        <v-icon v-text="item.icon"></v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title v-text="item.text"></v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-item-group>
        </v-list>
    </v-menu>
</main-menu-component>
