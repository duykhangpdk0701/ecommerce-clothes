import { IAdminColor } from "interfaces/Color";
import axiosClient from "../axiosClient";

const adminItemColorAPI = {
  getListOfItemColor: async (): Promise<IAdminColor[]> => {
    const url = "/api/v1/admin/item-color";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminItemColorAPI;
