<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { dashboard } from '@/routes';
import products from '@/routes/products/index.js';
import Button from '@/components/ui/button/Button.vue';
import { Plus } from '@lucide/vue';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
            {
                title: 'Products',
                href: products.index(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Products" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <div class="absolute top-1.5 flex items-center justify-end gap-2 right-4">
        <Button>
          <Link :href="products.create()" class="flex gap-1">
          <Plus /> Add Product
          </Link>
        </Button>
      </div>
    </div>
</template>
