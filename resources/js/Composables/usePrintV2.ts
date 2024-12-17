import { ref } from "vue";

interface OptionsType {
  pageSizes?: string;
  pageMargins?: number[];
  pageOrientation?: "portrait" | "landscape";
  pageFormat?: string;
  pagePrintBackground?: boolean;
  printTitle?: string;
}

export default function usePrintV2() {
  const printLoading = ref(false);

  const printDiv = async (
    divId: string,
    options: OptionsType = {},
    delayPrintLoading = 500,
  ) => {
    printLoading.value = true;

    const setOptions = {
      pageMargins: [10, 10, 10, 10],
      pagePrintBackground: true,
      pageOrientation: "portrait",
      pageFormat: "A4",
      printTitle: "Print - Norton University",
      ...options,
    };

    const pageStyles = `
      @page {
        size: ${setOptions.pageFormat} ${setOptions.pageOrientation};
        margin: ${setOptions.pageMargins[0]}mm ${setOptions.pageMargins[1]}mm ${setOptions.pageMargins[2]}mm ${setOptions.pageMargins[3]}mm;
        background: ${setOptions.pagePrintBackground ? "white" : "transparent"};
      }
    `;

    let headContent = document.head.innerHTML
      .replaceAll(/<script[^>]*>([\s\S]*?)<\/script>/gi, "")
      .replaceAll(/<link[^>]*rel="modulepreload"[^>]*>/gi, "")
      .replaceAll(/<link[^>]*rel="preload"[^>]*>/gi, "")
      .replaceAll(
        /<title[^>]*>([\s\S]*?)<\/title>/gi,
        `<title>${setOptions.printTitle}</title>`,
      );

    headContent = headContent.replaceAll(
      /<link[^>]*href="([^"]*)"[^>]*>/gi,
      (match, capture) => {
        return capture.startsWith("http")
          ? match
          : match.replaceAll(capture, window.location.origin + capture);
      },
    );

    let divContent = document
      .getElementById(divId)
      .innerHTML.replaceAll(
        /<img[^>]*src="([^"]*)"[^>]*>/gi,
        (match, capture) => {
          return capture.startsWith("http")
            ? match
            : match.replaceAll(capture, window.location.origin + capture);
        },
      )
      .replaceAll(/<[^>]*print:hidden[^>]*>([\s\S]*?)<\/[^>]*>/gi, "");

    const headContentStyle = `${headContent}<style>${pageStyles}</style>`;
    const htmlContent = `<!DOCTYPE html><html lang="en"><head>${headContentStyle}</head><body>${divContent}</body></html>`;

    const temUrl = URL.createObjectURL(
      new Blob([htmlContent], { type: "text/html" }),
    );
    const iframe = document.createElement("iframe");
    iframe.src = temUrl;
    iframe.classList.add("sr-only");

    document.body.appendChild(iframe);
    iframe.onload = async () => {
      if (iframe.contentWindow.document.readyState === "complete") {
        await new Promise((resolve) => setTimeout(resolve, 500));
        iframe.contentWindow.print();
        printLoading.value = false;
        // remove iframe after print done
        iframe.contentWindow.onafterprint = () => {
          document.body.removeChild(iframe);
          URL.revokeObjectURL(temUrl);
        };
      }
    };
  };

  return { printDiv, printLoading };
}
