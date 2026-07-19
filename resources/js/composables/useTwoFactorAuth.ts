import { useHttp } from '@inertiajs/vue3';
import type { ComputedRef, Ref } from 'vue';
import { computed, ref } from 'vue';
import { qrCode, recoveryCodes, secretKey } from '@/routes/two-factor';

export type UseTwoFactorAuthReturn = {
    qrCodeSvg: Ref<string | null>;
    manualSetupKey: Ref<string | null>;
    recoveryCodesList: Ref<string[]>;
    errors: Ref<string[]>;
    hasSetupData: ComputedRef<boolean>;
    clearTwoFactorAuthData: () => void;
    fetchSetupData: () => Promise<void>;
    fetchRecoveryCodes: () => Promise<void>;
};

const errors = ref<string[]>([]);
const manualSetupKey = ref<string | null>(null);
const qrCodeSvg = ref<string | null>(null);
const recoveryCodesList = ref<string[]>([]);

const hasSetupData = computed(
    () => qrCodeSvg.value !== null && manualSetupKey.value !== null,
);

export const useTwoFactorAuth = (): UseTwoFactorAuthReturn => {
    const http = useHttp();

    const clearErrors = (): void => {
        errors.value = [];
    };

    const fetchSetupData = async (): Promise<void> => {
        clearErrors();

        try {
            const [qrCodeResponse, secretKeyResponse] = await Promise.all([
                http.submit(qrCode()),
                http.submit(secretKey()),
            ]);

            qrCodeSvg.value = (qrCodeResponse as { svg: string }).svg;
            manualSetupKey.value = (
                secretKeyResponse as { secretKey: string }
            ).secretKey;
        } catch {
            errors.value = ['Unable to load the two-factor setup data.'];
            qrCodeSvg.value = null;
            manualSetupKey.value = null;
        }
    };

    const fetchRecoveryCodes = async (): Promise<void> => {
        clearErrors();

        try {
            recoveryCodesList.value = (await http.submit(
                recoveryCodes(),
            )) as string[];
        } catch {
            errors.value = ['Unable to load the recovery codes.'];
            recoveryCodesList.value = [];
        }
    };

    const clearTwoFactorAuthData = (): void => {
        qrCodeSvg.value = null;
        manualSetupKey.value = null;
        recoveryCodesList.value = [];
        clearErrors();
    };

    return {
        qrCodeSvg,
        manualSetupKey,
        recoveryCodesList,
        errors,
        hasSetupData,
        clearTwoFactorAuthData,
        fetchSetupData,
        fetchRecoveryCodes,
    };
};
