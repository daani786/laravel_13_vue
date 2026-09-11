<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { dashboard } from '@/routes';
import products from '@/routes/products/index.js';
import Button from '@/components/ui/button/Button.vue';
import { Plus } from '@lucide/vue';
import Product from '@/types/Product.ts';
import Table from '@/components/ui/table/Table.vue';
import TableHeader from '@/components/ui/table/TableHeader.vue';
import TableRow from '@/components/ui/table/TableRow.vue';
import TableHead from '@/components/ui/table/TableHead.vue';
import TableBody from '@/components/ui/table/TableBody.vue';
import TableCell from '@/components/ui/table/TableCell.vue';

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

const props = defineProps<{
    collection: Product,
}>();
console.log('collection', props.collection);
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
      <Table>
        <TableHeader>
            <TableRow>
                <TableHead>Name</TableHead>
                <TableHead>Description</TableHead>
                <TableHead class="text-end">Actions</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="item in collection.data" :key="item.id">
                <TableCell>{{ item.name  }}</TableCell>
                <TableCell>{{ item.description }}</TableCell>
            </TableRow>
        </TableBody>
      </Table>
    </div>
</template>
