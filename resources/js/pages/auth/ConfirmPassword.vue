<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { store } from '@/routes/password/confirm';

defineOptions({
    layout: {
        title: 'Confirm password',
        description:
            'This is a secure area. Confirm your password before continuing.',
    },
});
</script>

<template>
    <Head title="Confirm password" />

    <Form
        v-bind="store.form()"
        reset-on-success
        v-slot="{ errors, processing }"
        class="space-y-6"
    >
        <div class="grid gap-2">
            <Label for="password">Password</Label>
            <PasswordInput
                id="password"
                name="password"
                required
                autocomplete="current-password"
                autofocus
            />
            <InputError :message="errors.password" />
        </div>

        <Button class="w-full" :disabled="processing">
            <Spinner v-if="processing" />
            Confirm password
        </Button>
    </Form>
</template>
