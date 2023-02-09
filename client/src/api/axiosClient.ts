import axios from "axios";

const axiosClient = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_SERVER,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});

axiosClient.interceptors.request.use(
  (config) => {
    if (config.headers) {
      config.headers["API-KEY"] = process.env.NEXT_PUBLIC_API_KEY as string;
    }

    const accessToken = null;
    if (accessToken && config.headers) {
      config.headers["Authorization"] = `Bearer ${accessToken}`;
    }

    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

axiosClient.interceptors.response.use(
  (res) => {
    if (res && res.data) {
      return res.data;
    }
    return res;
  },
  (error) => {
    return Promise.reject(
      error.response
        ? { ...error.response.data, code: error.response.status }
        : {}
    );
  }
);
export default axiosClient;
