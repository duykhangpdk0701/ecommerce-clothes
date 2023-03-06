import axiosClient from "./axiosClient";

const checkoutAPI = {
  getListPaymentMethod: async () => {
    const url = "api/v1/cart/payment-method";
    const res = await axiosClient.get(url);
    return res.data;
  },

  confirmCheckout: async (
    quoteId: number,
    shippingName: string,
    shippingCityId: string,
    shippingDistrictId: string,
    shippingWardId: string,
    shippingAddressId: string,
    shippingPhone: string,
    comment: string,
    paymentMethodId: number
  ): Promise<any> => {
    const url = "api/v1/cart/confirm-checkout";
    const res = await axiosClient.post(url, {
      quote_id: quoteId,
      shipping_name: shippingName,
      shipping_city_id: shippingCityId,
      shipping_district_id: shippingDistrictId,

      shipping_ward_id: shippingWardId,
      shipping_address: shippingAddressId,

      shipping_phone: shippingPhone,
      comment,
      payment_method_id: paymentMethodId,
    });
    return res.data;
  },
};

export default checkoutAPI;
