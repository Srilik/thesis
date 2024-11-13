import axios, { AxiosRequestConfig, AxiosResponse } from "axios";
import Swal from "sweetalert2";
import { ref } from "vue";

export default function useAxios() {
    // const source = ref(axios.CancelToken.source());
    const error = ref(null);
    const loading = ref(false);
    const validationErrors = ref([]);

    const fetch = async <T>(
        url: string,
        config?: AxiosRequestConfig,
    ): Promise<AxiosResponse> => {
        try {
            loading.value = true;
            const response = await axios<T>(url, {
                ...config,
            });
            return response;
        } catch (error) {
            error.value = error.response?.data;
            validationErrors.value = error.response?.data?.errors;
            if (axios.isCancel(error)) {
                // console.log("Request canceled", error.message);
                // reset cancel token
                // source.value = axios.CancelToken.source();
                return {
                    data: null,
                    status: 0,
                    statusText: "Request canceled",
                    headers: null,
                    config: error?.config,
                };
            } else {
                if (error.response?.status === 419) {
                    await Swal.fire({
                        title: "Session Expired",
                        text: "Your session has expired. Please refresh the page.",
                        icon: "warning",
                        confirmButtonText: "Refresh",
                        showCancelButton: false,
                    });
                    window.location.reload();
                } else {
                    await Swal.fire({
                        title: `${JSON.stringify(
                            error.response?.status,
                        )} ${errorStatusCodes(error.response?.status)}`,
                        text: error.response?.data?.message,
                        icon: "error",
                        confirmButtonText: "OK",
                        showCancelButton: false,
                    });
                }
            }
            // throw new Error(JSON.stringify(error.response?.data));
        } finally {
            loading.value = false;
        }
    };

    const errorStatusCodes = (code: number) => {
        switch (code) {
            case 401:
                return "Unauthorized";
            case 403:
                return "Forbidden";
            case 404:
                return "Not Found";
            case 419:
                return "Session Expired";
            case 422:
                return "Unprocessable Entity";
            case 500:
                return "Internal Server Error";
            default:
                return "Error";
        }
    };

    return { fetch, error, loading };
}
