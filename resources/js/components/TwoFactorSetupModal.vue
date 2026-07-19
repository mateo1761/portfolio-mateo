<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { Check, Copy } from '@lucide/vue';
import { useClipboard } from '@vueuse/core';
import { computed, ref, watch } from 'vue';
import AlertError from '@/components/AlertError.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Spinner } from '@/components/ui/spinner';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { confirm } from '@/routes/two-factor';

const props = defineProps<{
    requiresConfirmation: boolean;
    twoFactorEnabled: boolean;
}>();

const isOpen = defineModel<boolean>('isOpen');
const { copy, copied } = useClipboard();
const { qrCodeSvg, manualSetupKey, errors, fetchSetupData } =
    useTwoFactorAuth();
const showConfirmation = ref(false);
const code = ref('');

const title = computed(() =>
    showConfirmation.value
        ? 'Confirm two-factor authentication'
        : 'Set up two-factor authentication',
);

watch(
    () => isOpen.value,
    async (open) => {
        if (open && !qrCodeSvg.value) {
            await fetchSetupData();
        }

        if (!open) {
            showConfirmation.value = false;
            code.value = '';
        }
    },
);
</script>

<template>
    <Dialog :open="isOpen" @update:open="isOpen = $event">
        <DialogContent class="sm:max-w-md">
            <DialogHeader>
                <DialogTitle>{{ title }}</DialogTitle>
                <DialogDescription>
                    Scan the QR code or enter the setup key in a TOTP
                    authenticator application.
                </DialogDescription>
            </DialogHeader>

            <AlertError v-if="errors.length" :errors="errors" />

            <template v-else-if="!showConfirmation">
                <div class="mx-auto size-64 rounded-lg border bg-white p-5">
                    <div
                        v-if="qrCodeSvg"
                        class="size-full"
                        v-html="qrCodeSvg"
                    />
                    <div
                        v-else
                        class="flex size-full items-center justify-center"
                    >
                        <Spinner />
                    </div>
                </div>

                <div
                    class="flex items-stretch overflow-hidden rounded-md border"
                >
                    <Input
                        readonly
                        :model-value="manualSetupKey ?? ''"
                        class="border-0 font-mono"
                    />
                    <Button
                        type="button"
                        variant="ghost"
                        class="rounded-none border-l"
                        :disabled="!manualSetupKey"
                        @click="copy(manualSetupKey ?? '')"
                    >
                        <Check v-if="copied" />
                        <Copy v-else />
                        <span class="sr-only">Copy setup key</span>
                    </Button>
                </div>

                <Button
                    class="w-full"
                    type="button"
                    @click="
                        props.requiresConfirmation
                            ? (showConfirmation = true)
                            : (isOpen = false)
                    "
                >
                    {{ props.twoFactorEnabled ? 'Close' : 'Continue' }}
                </Button>
            </template>

            <Form
                v-else
                v-bind="confirm.form()"
                error-bag="confirmTwoFactorAuthentication"
                reset-on-error
                @finish="code = ''"
                @success="isOpen = false"
                v-slot="{ errors: formErrors, processing }"
                class="space-y-4"
            >
                <Input
                    v-model="code"
                    name="code"
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    maxlength="6"
                    pattern="[0-9]*"
                    placeholder="123456"
                    autofocus
                />
                <InputError :message="formErrors.code" />

                <div class="flex gap-3">
                    <Button
                        type="button"
                        variant="outline"
                        class="flex-1"
                        :disabled="processing"
                        @click="showConfirmation = false"
                    >
                        Back
                    </Button>
                    <Button
                        type="submit"
                        class="flex-1"
                        :disabled="processing || code.length !== 6"
                    >
                        Confirm
                    </Button>
                </div>
            </Form>
        </DialogContent>
    </Dialog>
</template>
