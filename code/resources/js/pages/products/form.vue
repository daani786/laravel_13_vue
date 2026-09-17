<script setup lang="ts">
import { Head, Form, router, usePage } from '@inertiajs/vue3';
import { dashboard } from '@/routes';
import products from '@/routes/products/index.js';
import Button from '@/components/ui/button/Button.vue';
import { Save, Upload } from '@lucide/vue';
import Card from '@/components/ui/card/Card.vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { Product } from '@/types';

const { url } = usePage();
let pageTitle = 'Create Product';
if (url != '/products/create') {
    pageTitle = 'Edit Product';
}
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
            {
                title: 'Product',
                href: '',
            },
        ],
    },
});

const props = defineProps<{
    product: Product;
}>();

const action = props.product.id
    ? products.update.form({ product: props.product.id })
    : products.store.form();

const handleFileChange = (event: any) => {
    let file = event.target.files[0];
    let reader = new FileReader();
    reader.onloadend = (file) => {
        props.product.image = reader.result as string
    };
    reader.readAsDataURL(file);
};
</script>

<template>
    <Head title="Products" />

    <div class="flex h-full flex-1 flex-col items-center gap-4 rounded-xl p-4">
        <Form v-bind="action" v-slot="{ errors, processing }">
            <div class="-mt-16.5 mb-7.5 flex justify-between gap-4 md:w-200">
                <h1 class="text-2xl">
                    {{ pageTitle }}
                </h1>
                <Button :disabled="processing">
                    <Save /> {{ processing ? 'Saving...' : 'Save Product' }}
                </Button>
            </div>
            <div class="grid gap-4 md:w-200">
                <div class="flex gap-4">
                    <div class="w-8/12">
                        <Card class="md-4 p-4">
                            <div class="grid w-full gap-2">
                                <Label for="name">Name</Label>
                                <Input
                                    class="mt-1 block w-full"
                                    id="name"
                                    name="name"
                                    :defaultValue="product.name"
                                    placeholder="Product Name"
                                />
                                <InputError :message="errors.name" />
                            </div>
                            <div class="grid w-full gap-2">
                                <Label for="description">Description</Label>
                                <Textarea
                                    class="mt-1 block w-full"
                                    id="description"
                                    name="description"
                                    :defaultValue="product.description"
                                    placeholder="Product Description"
                                />
                                <InputError :message="errors.description" />
                            </div>
                        </Card>
                    </div>
                    <div class="w-4/12">
                        <Card class="md-4 p-4">
                            <div class="group relative grid place-items-center overflow-hidden-rounded-md bg-muted transition-all hover:bg-primary/10 spect-square">
                                <input id="image" type="file" name="image" :defaultValue="product.image" @change="handleFileChange" class="absolute inset-0 z-10 cursor-pointer opacity-0" multiple/>
                                <Upload class="hidden" />
                                <img :src="product.image ? product.image : '/apple-touch-icon.png'" class="h-50 w-50" />
                            </div>
                        </Card>
                    </div>
                </div>

            </div>
            <div class="mt-8 flex justify-between md:w-200">
                <Button
                    type="button"
                    variant="secondary"
                    @click="router.visit(products.index())"
                    >Cancel</Button
                >
                <Button :disabled="processing">
                    <Save /> {{ processing ? 'Saving...' : 'Save Product' }}
                </Button>
            </div>
        </Form>
    </div>
</template>
