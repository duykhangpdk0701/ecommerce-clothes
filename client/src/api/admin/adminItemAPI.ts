import { IAdminProduct } from "interfaces/Product";
import axiosClient from "../axiosClient";

const adminItemAPI = {
  getListOfItem: async (): Promise<IAdminProduct> => {
    const url = "/api/v1/admin/item";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminItemAPI;
