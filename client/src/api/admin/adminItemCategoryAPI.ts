import { IAdminCategory } from "interfaces/Category";
import axiosClient from "../axiosClient";

const adminItemCategoryAPI = {
  getListOfItemCategory: async (): Promise<IAdminCategory[]> => {
    const url = "/api/v1/admin/item-category";
    const res = await axiosClient.get(url);
    return res.data;
  },

  getItemCategoryBySlug: async (slug: string): Promise<IAdminCategory> => {
    const url = `/api/v1/admin/item-category/${slug}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminItemCategoryAPI;
