import { HttpResponseError } from '@inertiajs/core';
import { useHttp } from '@inertiajs/vue3';
import type { ComputedRef, Ref } from 'vue';
import { computed, ref } from 'vue';
import { qrCode, recoveryCodes, secretKey } from '@/routes/two-factor';

export type UseTwoFactorAuthReturn = {
    qrCodeSvg: Ref<string | null>;
    manualSetupKey: Ref<string | null>;
    recoveryCodesList: Ref<string[]>;
    errors: Ref<string[]>;
    isLoadingSetupData: Ref<boolean>;
    hasSetupData: ComputedRef<boolean>;
    clearTwoFactorAuthData: () => void;
    fetchSetupData: () => Promise<void>;
    fetchRecoveryCodes: () => Promise<void>;
};

const errors = ref<string[]>([]);
const manualSetupKey = ref<string | null>(null);
const qrCodeSvg = ref<string | null>(null);
const recoveryCodesList = ref<string[]>([]);
const isLoadingSetupData = ref(false);

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
        qrCodeSvg.value = null;
        manualSetupKey.value = null;
        isLoadingSetupData.value = true;

        try {
            const qrCodeResponse = await http.submit(qrCode());
            const secretKeyResponse = await http.submit(secretKey());

            qrCodeSvg.value = (qrCodeResponse as { svg: string }).svg;
            manualSetupKey.value = (
                secretKeyResponse as { secretKey: string }
            ).secretKey;
        } catch (error) {
            errors.value = [
                error instanceof HttpResponseError &&
                [401, 403, 419].includes(error.response.status)
                    ? 'Tu sesión o la confirmación de contraseña venció. Vuelve a confirmar tu contraseña e inténtalo nuevamente.'
                    : 'No pudimos cargar el código QR. Revisa tu conexión e inténtalo nuevamente.',
            ];
        } finally {
            isLoadingSetupData.value = false;
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
        isLoadingSetupData,
        hasSetupData,
        clearTwoFactorAuthData,
        fetchSetupData,
        fetchRecoveryCodes,
    };
};
