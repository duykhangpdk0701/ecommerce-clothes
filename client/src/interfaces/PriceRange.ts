interface IPriceRange {
  success: boolean;
  data: {
    min_price: string;
    max_price: string;
  };
  error: string;
}

export default IPriceRange;
