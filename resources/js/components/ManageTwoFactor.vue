<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { ShieldCheck } from '@lucide/vue';
import { onUnmounted, ref } from 'vue';
import Heading from '@/components/Heading.vue';
import TwoFactorRecoveryCodes from '@/components/TwoFactorRecoveryCodes.vue';
import TwoFactorSetupModal from '@/components/TwoFactorSetupModal.vue';
import { Button } from '@/components/ui/button';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { disable, enable } from '@/routes/two-factor';

export type Props = {
    canManageTwoFactor?: boolean;
    requiresConfirmation?: boolean;
    twoFactorEnabled?: boolean;
};

withDefaults(defineProps<Props>(), {
    canManageTwoFactor: false,
    requiresConfirmation: false,
    twoFactorEnabled: false,
});

const { hasSetupData, clearTwoFactorAuthData } = useTwoFactorAuth();
const showSetupModal = ref(false);

onUnmounted(clearTwoFactorAuthData);
</script>

<template>
    <div v-if="canManageTwoFactor" class="space-y-6">
        <Heading
            variant="small"
            title="Two-factor authentication"
            description="Manage TOTP authentication and recovery codes"
        />

        <div v-if="!twoFactorEnabled" class="space-y-4">
            <p class="text-sm text-muted-foreground">
                Add an authenticator application to require a time-based code
                when signing in.
            </p>

            <Button v-if="hasSetupData" @click="showSetupModal = true">
                <ShieldCheck />
                Continue setup
            </Button>

            <Form
                v-else
                v-bind="enable.form()"
                @success="showSetupModal = true"
                #default="{ processing }"
            >
                <Button type="submit" :disabled="processing">
                    Enable 2FA
                </Button>
            </Form>
        </div>

        <div v-else class="space-y-4">
            <p class="text-sm text-muted-foreground">
                Two-factor authentication is enabled for your account.
            </p>

            <Form v-bind="disable.form()" #default="{ processing }">
                <Button
                    type="submit"
                    variant="destructive"
                    :disabled="processing"
                >
                    Disable 2FA
                </Button>
            </Form>

            <TwoFactorRecoveryCodes />
        </div>

        <TwoFactorSetupModal
            v-model:is-open="showSetupModal"
            :requires-confirmation="requiresConfirmation"
            :two-factor-enabled="twoFactorEnabled"
        />
    </div>
</template>
