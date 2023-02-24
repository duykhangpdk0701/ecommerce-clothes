import { IAdminProduct } from "@/interfaces/Product";
import axiosClient from "../axiosClient";

const adminItemAPI = {
  getListOfItem: async (): Promise<IAdminProduct> => {
    const url = "/api/v1/admin/item";
    const res = await axiosClient.get(url);
    return res.data;
  },

  createItem: async (
    name: string,
    sku: string,
    description: string,
    brandId: number,
    itemCategoriesId: number[],
    thumbnailImage: File,
    detailImages: File[],
    itemPersonTypeId: number,
    itemStockStatusId: number,
    itemSizes: number[],
    itemColors: number[],
    status: boolean
  ): Promise<IAdminProduct> => {
    const url = "/api/v1/admin/item";
    const data = new FormData();
    data.append("name", name);
    data.append("sku", sku);
    data.append("description", description);
    data.append("brand_id", brandId.toString());
    itemCategoriesId.forEach((item) => {
      data.append("item_categories[]", item.toString());
    });
    data.append("thumbnail_image", thumbnailImage);
    detailImages.forEach((value) => {
      data.append("detail_images[]", value);
    });
    data.append("item_person_type_id", itemPersonTypeId.toString());
    data.append("item_stock_status_id", "1");
    data.append("item_sizes", itemSizes.toString());
    itemSizes.forEach((value) => {
      data.append("item_sizes[]", value.toString());
    });
    itemColors.forEach((value) => {
      data.append("item_colors[]", value.toString());
    });

    const config = { headers: { "Content-Type": "multipart/form-data" } };

    const res = await axiosClient.post(url, data, config);
    return res.data;
  },
};

export default adminItemAPI;
