<script setup lang="ts">
import { Head, Form, router } from '@inertiajs/vue3';
import { dashboard } from '@/routes';
import products from '@/routes/products/index.js';
import Button from '@/components/ui/button/Button.vue';
import { Save } from '@lucide/vue';
import Card from '@/components/ui/card/Card.vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue'
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { Product } from '@/types';

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

defineProps<{
    product: Product,
}>();

</script>

<template>
    <Head title="Products" />

    <div
        class="flex h-full flex-1 flex-col gap-4 items-center rounded-xl p-4"
    >
        <Form v-bind="products.store.form()" v-slot="{ errors, processing }">
            <div class="-mt-16.5 mb-7.5 flex justify-between gap-4 md:w-200">
                <h1 class="text-2xl">Create Product</h1>
                <Button :disabled="processing">
                    <Save /> {{ processing ? 'Saving...' : 'Save Product' }}
                </Button>
            </div>
            <div class="grid gap-4 md:w-200">
                <Card class="md-4 p-4">
                    <div class="grid w-full gap-2">
                        <Label for="name">Name</Label>
                        <Input class="mt-1 block w-full" id="name" name="name" :defaultValue="product.name" placeholder="Product Name" />
                        <InputError :message="errors.name" />
                    </div>
                    <div class="grid w-full gap-2">
                        <Label for="description">Description</Label>
                        <Textarea class="mt-1 block w-full" id="description" name="description" :defaultValue="product.description" placeholder="Product Description" />
                        <InputError :message="errors.description" />
                    </div>
                </Card>
            </div>
            <div class="mt-8 flex justify-between md:w-200">
                <Button type="button" variant="secondary" @click="router.visit(products.index())">Cancel</Button>
                <Button :disabled="processing">
                    <Save /> {{ processing ? 'Saving...' : 'Save Product' }}
                </Button>
            </div>
        </Form>
    </div>
</template>
