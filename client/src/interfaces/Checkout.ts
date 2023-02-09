interface ICheckout {
  quoteId: number | null;
  shippingName: string | null;
  shippingCityId: number | null;
  shippingDistrictId: number | null;
  shippingWardId: number | null;
  shippingAddress: string | null;
  shippingPhone: string | null;
  comment?: string;
  paymentMeThodId: number | null;
}

export default ICheckout;
