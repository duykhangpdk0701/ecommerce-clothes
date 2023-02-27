import IItemVariant from "@/interfaces/ItemVariant";
import axiosClient from "../axiosClient";

const adminItemVariantAPI = {
  getListOfItemVariant: async (): Promise<IItemVariant[]> => {
    const url = "/api/v1/admin/item-variant";
    const res = await axiosClient.get(url);
    return res.data;
  },

  getListOfItemVarinatByItemId: async (id: number): Promise<IItemVariant[]> => {
    const url = `/api/v1/admin/item-variant/item/${id}`;
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default adminItemVariantAPI;
