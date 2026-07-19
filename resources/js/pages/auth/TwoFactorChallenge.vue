<script setup lang="ts">
import { Form, Head, setLayoutProps } from '@inertiajs/vue3';
import { computed, ref, watchEffect } from 'vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { store } from '@/routes/two-factor/login';

const useRecoveryCode = ref(false);
const code = ref('');

const content = computed(() =>
    useRecoveryCode.value
        ? {
              title: 'Recovery code',
              description: 'Enter one of your emergency recovery codes.',
          }
        : {
              title: 'Authentication code',
              description: 'Enter the code from your authenticator app.',
          },
);

watchEffect(() => setLayoutProps(content.value));

const toggleMode = (clearErrors: () => void): void => {
    useRecoveryCode.value = !useRecoveryCode.value;
    code.value = '';
    clearErrors();
};
</script>

<template>
    <Head title="Two-factor authentication" />

    <Form
        v-bind="store.form()"
        reset-on-error
        @error="code = ''"
        #default="{ errors, processing, clearErrors }"
        class="space-y-4"
    >
        <template v-if="useRecoveryCode">
            <Input
                name="recovery_code"
                autocomplete="one-time-code"
                placeholder="Recovery code"
                required
                autofocus
            />
            <InputError :message="errors.recovery_code" />
        </template>

        <template v-else>
            <Input
                v-model="code"
                name="code"
                inputmode="numeric"
                autocomplete="one-time-code"
                maxlength="6"
                pattern="[0-9]*"
                placeholder="123456"
                required
                autofocus
            />
            <InputError :message="errors.code" />
        </template>

        <Button type="submit" class="w-full" :disabled="processing">
            Continue
        </Button>

        <div class="text-center text-sm text-muted-foreground">
            <button
                type="button"
                class="text-foreground underline underline-offset-4"
                @click="toggleMode(clearErrors)"
            >
                Use
                {{
                    useRecoveryCode
                        ? 'an authentication code'
                        : 'a recovery code'
                }}
            </button>
        </div>
    </Form>
</template>
