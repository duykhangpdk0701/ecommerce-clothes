import ICategory from "interfaces/Category";
import axiosClient from "../axiosClient";

const adminItemCategoryAPI = {
  getListOfItemCategory: async (): Promise<ICategory[]> => {
    const url = "/api/v1/admin/item-category";
    const res = await axiosClient.get(url);
    return res.data;
  },

  getItemCategoryBySlug: async (slug: string): Promise<ICategory> => {
    const url = `/api/v1/admin/item-category/${slug}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminItemCategoryAPI;
