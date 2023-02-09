import IBrand from "interfaces/Brand";
import axiosClient from "../axiosClient";

const adminBrandAPI = {
  getListOfBrand: async (): Promise<IBrand[]> => {
    const url = "/api/v1/brand?is_show=0";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminBrandAPI;
