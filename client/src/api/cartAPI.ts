import IQuotes from "@/interfaces/Quotes";
import axiosClient from "./axiosClient";

const cartAPI = {
  createCart: async (
    itemVariant: number,
    quantity: number
  ): Promise<IQuotes> => {
    const url = "/api/v1/cart/add-to-cart";
    const res = await axiosClient.post(url, {
      item_variant: itemVariant,
      quantity,
    });
    return res.data;
  },

  addToCart: async (
    itemVariant: number,
    quoteId: number,
    quantity: number
  ): Promise<IQuotes> => {
    const url = "/api/v1/cart/add-to-cart";
    const res = await axiosClient.post(url, {
      item_variant: itemVariant,
      quote_id: quoteId,
      quantity,
    });
    return res.data;
  },

  plusItemQuantity: async (
    quoteDetailId: number,
    quoteId: number
  ): Promise<IQuotes> => {
    const url = "/api/v1/cart/plus-cart";
    const res = await axiosClient.put(url, {
      quote_detail_id: quoteDetailId,
      quote_id: quoteId,
    });
    return res.data;
  },

  minusItemQuantity: async (
    quoteDetailId: number,
    quoteId: number
  ): Promise<IQuotes> => {
    const url = "/api/v1/cart/minus-cart";
    const res = await axiosClient.put(url, {
      quote_detail_id: quoteDetailId,
      quote_id: quoteId,
    });
    return res.data;
  },

  deleleteItemQuantity: async (
    quoteDetailId: number,
    quoteId: number
  ): Promise<IQuotes> => {
    const url = "/api/v1/cart/delete-item-cart";
    const res = await axiosClient.put(url, {
      quote_detail_id: quoteDetailId,
      quote_id: quoteId,
    });
    return res.data;
  },

  getQuoteByUser: async (): Promise<IQuotes> => {
    const url = "/api/v1/cart/get-quote-by-user";
    const res = await axiosClient.get(url);
    return res.data;
  },
};

export default cartAPI;
