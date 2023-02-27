import IProduct from "@/interfaces/Product";
import axiosClient from "./axiosClient";

const itemAPI = {
  getListOfItem: async (): Promise<IProduct[]> => {
    const url = "/api/v1/item";
    const res = await axiosClient.get(url);
    return res.data;
  },

  getItemBySlug: async (slug: string): Promise<IProduct> => {
    const url = `/api/v1/item/${slug}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default itemAPI;
