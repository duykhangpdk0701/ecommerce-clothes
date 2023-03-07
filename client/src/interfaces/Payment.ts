interface IPayment {
  id: number;
  name: {
    vi : string,
    en : string,
  };
  key: string;
  fee: string;
  fee_type: number;
}

export default IPayment;
