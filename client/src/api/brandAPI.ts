import IBrand from "@/interfaces/Brand";
import axiosClient from "./axiosClient";

const brandAPI = {
  getListOfBrand: async (): Promise<IBrand[]> => {
    const url = "/api/v1/brand";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default brandAPI;
