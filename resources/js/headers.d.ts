declare type ToastType = "info" | "success" | "warning" | "error";

declare interface Toast {
    id: number;
    type: ToastType;
    message: string;
    visible: boolean;
}

declare interface ToastStore {
    counter: number;
    createToast: (message: string, type: ToastType) => void;
    destroyToast: (index: number) => void;
    list: Toast[]
}
