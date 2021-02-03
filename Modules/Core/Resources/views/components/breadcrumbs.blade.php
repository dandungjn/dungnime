<div class="ml-8 mt-8">
    <h3>{{ $breadcrumb_title }}</h3>
    <v-breadcrumbs
        class="px-0 py-2" 
        :items='@json($breadcrumbs)'>
        <template v-slot:item="{ item }">
            <v-breadcrumbs-item
                :href="item.href"
                :disabled="item.disabled"
            >
                <v-icon v-if="item.text == 'mdi-home'" v-text="item.text"></v-icon>
                <span v-else>@{{ item.text }}</span>
            </v-breadcrumbs-item>
        </template>
    </v-breadcrumbs>
</div>

