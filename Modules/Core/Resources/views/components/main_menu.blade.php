<main-menu-component
    class="scroll-bar"
    elevation="3"
    inline-template
    :menu='@json(prepare_main_menu())'>
    <v-list nav dense>
        <template v-for="item in menu">
            <div v-if="item.children"
            class="my-4">
                <v-list-group       
                    v-if="item.show"
                    :key="item.text"
                    v-model="item.model"
                    :prepend-icon="item.icon"
                    no-action
                    active-class="main-menu--active"
                >
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
                    </template>

                    <v-list-item
                        v-for="(child, i) in item.children"
                        v-if="child.show"
                        :key="i"
                        v-model="child.model"
                        link
                        :href="ziggy(child.uri).url()"
                        color="white"
                        class="pl-7 my-2"
                    >
                        <v-list-item-action v-if="child.icon" class="mr-5">
                            <v-icon small>mdi-adjust</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                @{{ child.text }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>
            </div>
            <div v-else
            class="my-4">
                <v-list-item
                    v-if="item.show"
                    :key="item.text"
                    v-model="item.model"
                    link
                    :href="ziggy(item.uri).url()"
                    color="primary"
                >
                    <v-list-item-action>
                        <v-icon>@{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            @{{ item.text }}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </div>
        </template>
    </v-list>
</main-menu-component>
