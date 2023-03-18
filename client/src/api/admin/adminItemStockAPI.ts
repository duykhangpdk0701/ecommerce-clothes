import queryString from "query-string";
import axiosClient from "../axiosClient";

const adminItemStockAPI = {
  getListOfItemStock: async (
    search?: string,
    limit: number = 5,
    page: number = 0
  ): Promise<any[]> => {
    const url = "/api/v1/admin/item-stock";
    const searchUrl = queryString.stringifyUrl(
      { url, query: { search, limit, page: page + 1 } },
      { arrayFormat: "index" }
    );
    const res = await axiosClient.get(searchUrl);
    return res.data;
  },

  addItemStock: async (
    inboundItem: {
      itemVariantId: number;
      priceIn: number;
      price: number;
      stockStatusId: number;
      quantity: number;
    }[]
  ): Promise<any> => {
    const url = "/api/v1/admin/item-stock";

    const reqInboundItem = inboundItem.map((value) => ({
      item_variant_id: value.itemVariantId,
      price_in: value.priceIn,
      price: value.price,
      stock_status_id: 1,
      quantity: value.quantity,
    }));

    const res = await axiosClient.post(url, {
      inbound_item: reqInboundItem,
    });
    return res.data;
  },
};
export default adminItemStockAPI;
