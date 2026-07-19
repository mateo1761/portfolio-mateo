<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { Eye, EyeOff, RefreshCw } from '@lucide/vue';
import { onMounted, ref } from 'vue';
import AlertError from '@/components/AlertError.vue';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { regenerateRecoveryCodes } from '@/routes/two-factor';

const { recoveryCodesList, fetchRecoveryCodes, errors } = useTwoFactorAuth();
const areRecoveryCodesVisible = ref(false);

const toggleRecoveryCodes = async (): Promise<void> => {
    if (
        !areRecoveryCodesVisible.value &&
        recoveryCodesList.value.length === 0
    ) {
        await fetchRecoveryCodes();
    }

    areRecoveryCodesVisible.value = !areRecoveryCodesVisible.value;
};

onMounted(fetchRecoveryCodes);
</script>

<template>
    <Card class="w-full">
        <CardHeader>
            <CardTitle>Recovery codes</CardTitle>
            <CardDescription>
                Store these one-time codes in a secure password manager.
            </CardDescription>
        </CardHeader>
        <CardContent class="space-y-4">
            <div class="flex flex-wrap gap-3">
                <Button type="button" @click="toggleRecoveryCodes">
                    <EyeOff v-if="areRecoveryCodesVisible" />
                    <Eye v-else />
                    {{ areRecoveryCodesVisible ? 'Hide' : 'View' }} codes
                </Button>

                <Form
                    v-if="areRecoveryCodesVisible && recoveryCodesList.length"
                    v-bind="regenerateRecoveryCodes.form()"
                    :options="{ preserveScroll: true }"
                    @success="fetchRecoveryCodes"
                    #default="{ processing }"
                >
                    <Button
                        type="submit"
                        variant="secondary"
                        :disabled="processing"
                    >
                        <RefreshCw />
                        Regenerate codes
                    </Button>
                </Form>
            </div>

            <AlertError v-if="errors.length" :errors="errors" />

            <div
                v-if="areRecoveryCodesVisible && !errors.length"
                class="grid gap-1 rounded-lg bg-muted p-4 font-mono text-sm"
            >
                <div
                    v-for="recoveryCode in recoveryCodesList"
                    :key="recoveryCode"
                >
                    {{ recoveryCode }}
                </div>
            </div>
        </CardContent>
    </Card>
</template>
