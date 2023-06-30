import install, { rpc } from "./lib/install"

const toastIdMap = new Map<string, string>();

export function installAddon(
  identifier: string,
  updateAddonList?: () => Promise<void>,
  toasts: ToastStore,
): Promise<void> {
  if (toastIdMap.has(identifier)) {
    // Dismiss any existing toasts for the same addon
    // toast.dismiss(toastIdMap.get(identifier)!);
  }

  // const toastId = toast.loading("Connecting...");
  toasts.createToast("Connecting...", "info");
  console.log("Connecting...")
  // toastIdMap.set(identifier, toastId);

  let lastToast = Date.now();
  let state: "connecting" | "installing" | "done" = "connecting";

  return new Promise((resolve) => {
    install({
      data: {
        identifier,
      },
      onConnect: () => {
        state = "installing";
        const waitToToast = Math.max(0, 500 - (Date.now() - lastToast));
        setTimeout(() => {
          if (state !== "installing") return;
          // toast.loading(
          //   "Connected to Replugged, please confirm the addon installation in Discord.",
          //   {
          //     id: toastId,
          //   },
          // );
          toasts.createToast("Connected to replugged, please confirm the addon installation in Discord.", "info");
          console.log("Connected to Replugged, please confirm the addon installation in Discord.");
          lastToast = Date.now();
        }, waitToToast);
      },
      onFinish: (res) => {
        state = "done";
        const waitToToast = Math.max(0, 500 - (Date.now() - lastToast));

        setTimeout(async () => {
          switch (res.kind) {
            case "SUCCESS":
              // toast.success(`${res.manifest.name} was successfully installed.`, {
              //   id: toastId,
              // });
                toasts.createToast(`${res.manifest.name} was successfully installed.`, "success");
                console.log(`${res.manifest.name} was successfully installed.`);

              await updateAddonList?.();
              break;
            case "ALREADY_INSTALLED":
              // toast.error(`${res.manifest.name} is already installed.`, {
              //   id: toastId,
              // });
                toasts.createToast(`${res.manifest.name} is already installed.`, "error");
                console.log(`${res.manifest.name} is already installed.`);
              break;
            case "FAILED":
              // toast.error("Failed to get addon info.", {
              //   id: toastId,
              // });
                toasts.createToast("Failed to get addon info.", "error")
                console.log("Failed to get addon info.")
              break;
            case "CANCELLED":
              // toast.error("Installation cancelled.", {
              //   id: toastId,
              // });
                toasts.createToast("Installation cancelled.", "error")
                console.log("Installation cancelled.")
              break;
            case "UNREACHABLE":
              // toast.error(
              //   "Could not connect to Replugged, please make sure Discord is open with the latest version of Replugged installed and try again.",
              //   {
              //     id: toastId,
              //   },
              // );
                toasts.createToast("Could not connect to Replugged, please make sure Discord is open with the latest version of Replugged installed and try again.", "error");
                console.log("Could not connect to Replugged, please make sure Discord is open with the latest version of Replugged installed and try again.")
              break;
          }

          resolve();
        }, waitToToast);
      },
    });
  });
}

export type AddonList = Record<"plugins" | "themes", string[]>;

export function getAddons(): Promise<AddonList | null> {
  return new Promise((resolve) => {
    rpc<Record<string, never>, AddonList>({
      cmd: "REPLUGGED_LIST_ADDONS",
      data: {},
      onFinish: (res) => {
        if ("kind" in res) return resolve(null);
        if ("code" in res) return resolve(null);

        resolve(res);
      },
    });
  });
}
